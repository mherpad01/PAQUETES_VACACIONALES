<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Vacacion;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function __construct()
    {
        // Solo usuarios autenticados pueden gestionar reservas
        $this->middleware('auth');
    }

    public function store(Vacacion $vacacion)
    {
        try {
            // Verificar si ya tiene una reserva para este paquete
            if (auth()->user()->hasReservado($vacacion->id)) {
                return back()->with('error', 'Ya tienes una reserva activa para este paquete vacacional.');
            }

            // Crear la reserva
            Reserva::create([
                'id_user' => auth()->id(),
                'id_vacacion' => $vacacion->id,
            ]);

            return back()->with('success', '¡Reserva realizada con éxito! Ahora puedes dejar comentarios sobre este paquete.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al realizar la reserva: ' . $e->getMessage());
        }
    }

    public function destroy(Vacacion $vacacion)
    {
        try {
            // Buscar la reserva del usuario para este paquete
            $reserva = Reserva::where('id_user', auth()->id())
                ->where('id_vacacion', $vacacion->id)
                ->first();

            // Verificar que existe la reserva
            if (!$reserva) {
                return back()->with('error', 'No tienes ninguna reserva activa para este paquete.');
            }

            // Eliminar la reserva
            $reserva->delete();

            return back()->with('success', 'Reserva cancelada correctamente.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cancelar la reserva: ' . $e->getMessage());
        }
    }

    public function misReservas()
    {
        try {
            // Obtener las reservas del usuario paginadas (10 por página)
            $reservas = Reserva::where('id_user', auth()->id())
                ->with(['vacacion.fotos', 'vacacion.tipo'])
                ->latest()
                ->paginate(10);

            return view('reservas.mis-reservas', compact('reservas'));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar tus reservas: ' . $e->getMessage());
        }
    }
}