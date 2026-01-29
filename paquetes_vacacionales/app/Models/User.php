<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Métodos para roles
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    public function isAdvanced()
    {
        return $this->rol === 'advanced';
    }

    public function isNormal()
    {
        return $this->rol === 'normal';
    }

    public function canCreateVacaciones()
    {
        return $this->isAdmin() || $this->isAdvanced();
    }

    // Relaciones
    public function vacaciones()
    {
        return $this->hasMany(Vacacion::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_user');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_user');
    }

    public function hasReservado($vacacionId)
    {
        return $this->reservas()->where('id_vacacion', $vacacionId)->exists();
    }




    //EVENTO PARA PREVENIR LA ELIMINACION CUANDO HAY DATOS RELACIONADOS
    protected static function booted()
    {
        static::deleting(function ($user) {
            // Opción 1: Impedir eliminar si tiene reservas activas
            if ($user->reservas()->count() > 0) {
                throw new \Exception('No se puede eliminar el usuario porque tiene reservas activas.');
            }
            
            // Opción 2: Eliminar en cascada (decidir qué hacer con sus vacaciones)
            // Si el usuario tiene paquetes, reasignarlos al admin o eliminarlos
            if ($user->vacaciones()->count() > 0) {
                throw new \Exception('No se puede eliminar el usuario porque tiene paquetes vacacionales creados.');
            }
            
            // Eliminar sus comentarios
            $user->comentarios()->delete();
        });
    }
}