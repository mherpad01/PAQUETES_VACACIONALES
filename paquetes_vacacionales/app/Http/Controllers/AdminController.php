<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'No tienes permiso para acceder a esta área.');
            }
            return $next($request);
        });
    }

    public function users()
    {
        try {
            $users = User::latest()->paginate(15);
            return view('admin.users.index', compact('users'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar los usuarios: ' . $e->getMessage());
        }
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'rol' => 'required|in:admin,advanced,normal',
            ]);

            $user->update($data);

            return redirect()->route('admin.users.index')
                ->with('success', "Usuario '{$user->name}' actualizado correctamente.");
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    public function destroyUser(User $user)
    {
        try {
            // No permitir que el admin se elimine a sí mismo
            if ($user->id === auth()->id()) {
                return back()->with('error', 'No puedes eliminar tu propia cuenta.');
            }

            // Verificar si tiene reservas
            if ($user->reservas()->count() > 0) {
                return back()->with('error', 'No se puede eliminar el usuario porque tiene ' . $user->reservas()->count() . ' reserva(s) activa(s).');
            }

            // Verificar si tiene paquetes
            if ($user->vacaciones()->count() > 0) {
                return back()->with('error', 'No se puede eliminar el usuario porque tiene ' . $user->vacaciones()->count() . ' paquete(s) vacacional(es) creado(s).');
            }

            $nombre = $user->name;
            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', "Usuario '{$nombre}' eliminado correctamente.");
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}