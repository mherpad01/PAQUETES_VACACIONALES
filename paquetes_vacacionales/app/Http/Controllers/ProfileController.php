<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de edición del perfil
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Actualizar la información del perfil del usuario
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            // Rellenar con los datos validados
            $request->user()->fill($request->validated());

            // Si cambió el email, resetear verificación
            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            // Guardar los cambios
            $request->user()->save();

            return Redirect::route('profile.edit')
                ->with('status', 'profile-updated');
                
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar el perfil: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar la cuenta del usuario
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            // Validar la contraseña actual
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ], [
                'password.required' => 'Debes introducir tu contraseña',
                'password.current_password' => 'La contraseña es incorrecta',
            ]);

            $user = $request->user();

            // Cerrar sesión
            Auth::logout();

            // Eliminar el usuario
            $user->delete();

            // Invalidar sesión y regenerar token
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors(), 'userDeletion');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la cuenta: ' . $e->getMessage());
        }
    }
}