<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Vacacion;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ComentarioController extends Controller
{
    public function __construct()
    {
        // Solo usuarios autenticados pueden gestionar comentarios
        $this->middleware('auth');
    }

    public function store(Request $request, Vacacion $vacacion)
    {
        try {
            // Verificar que el usuario tiene una reserva para este paquete
            if (!auth()->user()->hasReservado($vacacion->id)) {
                return back()->with('error', 'Solo puedes comentar en paquetes vacacionales que hayas reservado.');
            }

            // Validación
            $data = $request->validate([
                'texto' => 'required|string|min:10|max:1000',
            ], [
                'texto.required' => 'El comentario es obligatorio',
                'texto.min' => 'El comentario debe tener al menos 10 caracteres',
                'texto.max' => 'El comentario no puede superar los 1000 caracteres',
            ]);

            // Crear el comentario
            Comentario::create([
                'id_user' => auth()->id(),
                'id_vacacion' => $vacacion->id,
                'texto' => $data['texto'],
            ]);

            return back()->with('success', 'Comentario publicado correctamente.');
            
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Error al publicar el comentario: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Comentario $comentario)
    {
        try {
            // Verificar permisos (solo el propietario o admin pueden editar)
            if ($comentario->id_user !== auth()->id() && !auth()->user()->isAdmin()) {
                abort(403, 'No tienes permiso para editar este comentario.');
            }

            // Validación
            $data = $request->validate([
                'texto' => 'required|string|min:10|max:1000',
            ], [
                'texto.required' => 'El comentario es obligatorio',
                'texto.min' => 'El comentario debe tener al menos 10 caracteres',
                'texto.max' => 'El comentario no puede superar los 1000 caracteres',
            ]);

            // Actualizar el comentario
            $comentario->update($data);

            return back()->with('success', 'Comentario actualizado correctamente.');
            
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el comentario: ' . $e->getMessage());
        }
    }

    public function destroy(Comentario $comentario)
    {
        try {
            // Verificar permisos (solo el propietario puede eliminar)
            if ($comentario->id_user !== auth()->id()) {
                abort(403, 'No tienes permiso para eliminar este comentario.');
            }

            // Eliminar el comentario
            $comentario->delete();

            return back()->with('success', 'Comentario eliminado correctamente.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el comentario: ' . $e->getMessage());
        }
    }
}