<?php

namespace App\Http\Controllers;

use App\Models\Vacacion;
use App\Models\Tipo;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VacacionController extends Controller
{
    public function __construct()
    {
        // Solo usuarios autenticados pueden crear/editar/eliminar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        try {
            $query = Vacacion::with(['tipo', 'user', 'fotos']);

            // Filtro por tipo
            if ($request->filled('tipo')) {
                $query->where('id_tipo', $request->tipo);
            }

            // Filtro por país
            if ($request->filled('pais')) {
                $query->where('pais', 'like', '%' . $request->pais . '%');
            }

            // Filtro por precio máximo
            if ($request->filled('precio_max')) {
                $query->where('precio', '<=', $request->precio_max);
            }

            // Búsqueda por título
            if ($request->filled('buscar')) {
                $query->where('titulo', 'like', '%' . $request->buscar . '%');
            }

            // Ordenamiento
            $orderBy = $request->get('order_by', 'created_at');
            $orderDir = $request->get('order_dir', 'desc');
            
            if (in_array($orderBy, ['created_at', 'precio', 'titulo'])) {
                $query->orderBy($orderBy, $orderDir);
            }

            $vacaciones = $query->paginate(9)->withQueryString();
            $tipos = Tipo::all();

            return view('vacaciones.index', compact('vacaciones', 'tipos'));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar los paquetes vacacionales: ' . $e->getMessage());
        }
    }

    public function show(Vacacion $vacacion)
    {
        try {
            $vacacion->load(['tipo', 'user', 'fotos', 'comentarios.user', 'reservas']);
            
            $tieneReserva = auth()->check() && auth()->user()->hasReservado($vacacion->id);
            
            return view('vacaciones.show', compact('vacacion', 'tieneReserva'));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar el paquete: ' . $e->getMessage());
        }
    }

    public function create()
    {
        // Verificar que el usuario puede crear
        if (!auth()->user()->canCreateVacaciones()) {
            abort(403, 'No tienes permiso para crear paquetes vacacionales.');
        }

        $tipos = Tipo::all();
        return view('vacaciones.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        try {
            // Verificar permisos
            if (!auth()->user()->canCreateVacaciones()) {
                abort(403, 'No tienes permiso para crear paquetes vacacionales.');
            }

            // Validación
            $data = $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string|min:20',
                'precio' => 'required|numeric|min:0',
                'pais' => 'required|string|max:255',
                'id_tipo' => 'required|exists:tipos,id',
                'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ], [
                'titulo.required' => 'El título es obligatorio',
                'descripcion.required' => 'La descripción es obligatoria',
                'descripcion.min' => 'La descripción debe tener al menos 20 caracteres',
                'precio.required' => 'El precio es obligatorio',
                'precio.numeric' => 'El precio debe ser un número',
                'precio.min' => 'El precio debe ser mayor o igual a 0',
                'pais.required' => 'El país es obligatorio',
                'id_tipo.required' => 'Debes seleccionar un tipo de viaje',
                'id_tipo.exists' => 'El tipo de viaje seleccionado no es válido',
                'imagenes.*.image' => 'Cada archivo debe ser una imagen',
                'imagenes.*.mimes' => 'Las imágenes deben ser de tipo: jpeg, png, jpg, gif o webp',
                'imagenes.*.max' => 'Cada imagen no debe superar los 2MB',
            ]);

            // Agregar user_id
            $data['user_id'] = auth()->id();

            // Crear el paquete
            $vacacion = Vacacion::create($data);

            // Procesar y guardar las imágenes
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    // Guardar en storage/app/public/vacaciones
                    $ruta = $imagen->store('vacaciones', 'public');
                    
                    // Crear registro en la tabla fotos
                    Foto::create([
                        'id_vacacion' => $vacacion->id,
                        'ruta' => $ruta,
                    ]);
                }
            }

            return redirect()->route('vacaciones.show', $vacacion)
                ->with('success', "Paquete '{$vacacion->titulo}' creado correctamente.");
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al crear el paquete: ' . $e->getMessage());
        }
    }

    public function edit(Vacacion $vacacion)
    {
        // Verificar permisos
        if (!$this->canModify($vacacion)) {
            abort(403, 'No tienes permiso para editar este paquete.');
        }

        $tipos = Tipo::all();
        return view('vacaciones.edit', compact('vacacion', 'tipos'));
    }

    public function update(Request $request, Vacacion $vacacion)
    {
        try {
            // Verificar permisos
            if (!$this->canModify($vacacion)) {
                abort(403, 'No tienes permiso para editar este paquete.');
            }

            // Validación
            $data = $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string|min:20',
                'precio' => 'required|numeric|min:0',
                'pais' => 'required|string|max:255',
                'id_tipo' => 'required|exists:tipos,id',
                'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'eliminar_fotos' => 'nullable|array',
                'eliminar_fotos.*' => 'exists:fotos,id',
            ], [
                'titulo.required' => 'El título es obligatorio',
                'descripcion.required' => 'La descripción es obligatoria',
                'descripcion.min' => 'La descripción debe tener al menos 20 caracteres',
                'precio.required' => 'El precio es obligatorio',
                'pais.required' => 'El país es obligatorio',
                'id_tipo.required' => 'Debes seleccionar un tipo de viaje',
                'imagenes.*.image' => 'Cada archivo debe ser una imagen',
                'imagenes.*.max' => 'Cada imagen no debe superar los 2MB',
            ]);

            // Actualizar datos básicos del paquete
            $vacacion->update([
                'titulo' => $data['titulo'],
                'descripcion' => $data['descripcion'],
                'precio' => $data['precio'],
                'pais' => $data['pais'],
                'id_tipo' => $data['id_tipo'],
            ]);

            // Eliminar fotos seleccionadas (el evento booted() se encarga de borrar el archivo)
            if ($request->filled('eliminar_fotos')) {
                Foto::whereIn('id', $request->eliminar_fotos)
                    ->where('id_vacacion', $vacacion->id)
                    ->delete();
            }

            // Subir nuevas imágenes
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    $ruta = $imagen->store('vacaciones', 'public');
                    
                    Foto::create([
                        'id_vacacion' => $vacacion->id,
                        'ruta' => $ruta,
                    ]);
                }
            }

            return redirect()->route('vacaciones.show', $vacacion)
                ->with('success', "Paquete '{$vacacion->titulo}' actualizado correctamente.");
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar el paquete: ' . $e->getMessage());
        }
    }

    public function destroy(Vacacion $vacacion)
    {
        try {
            // Verificar permisos
            if (!$this->canModify($vacacion)) {
                abort(403, 'No tienes permiso para eliminar este paquete.');
            }

            // Verificar si hay reservas activas
            if ($vacacion->reservas()->count() > 0) {
                return back()->with('error', 'No se puede eliminar este paquete porque tiene ' . $vacacion->reservas()->count() . ' reserva(s) activa(s). Primero deben cancelarse las reservas.');
            }

            $titulo = $vacacion->titulo;
            
            // El evento booted() en los modelos se encarga de:
            // 1. Eliminar todas las fotos (archivos del storage)
            // 2. Eliminar registros de fotos de la BD
            // 3. Eliminar comentarios asociados
            $vacacion->delete();

            return redirect()->route('vacaciones.index')
                ->with('success', "Paquete '{$titulo}' eliminado correctamente.");
                
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el paquete: ' . $e->getMessage());
        }
    }

    /**
     * Verifica si el usuario puede modificar (editar/eliminar) la vacación
     */
    private function canModify(Vacacion $vacacion)
    {
        $user = auth()->user();
        
        // Admin puede modificar todo
        if ($user->isAdmin()) {
            return true;
        }

        // Advanced solo puede modificar lo suyo
        if ($user->isAdvanced() && $vacacion->user_id === $user->id) {
            return true;
        }

        return false;
    }
}