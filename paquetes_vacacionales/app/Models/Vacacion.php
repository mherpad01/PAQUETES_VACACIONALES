<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    use HasFactory;

    protected $table = 'vacaciones';

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'pais',
        'id_tipo',
        'user_id',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    // Relaciones
    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'id_tipo');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'id_vacacion');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_vacacion');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_vacacion');
    }

    // Verificar si el usuario tiene reserva
    public function hasReserva($userId)
    {
        return $this->reservas()->where('id_user', $userId)->exists();
    }

    /**
     * Accesor para imagen principal
     * Usa el atributo 'url' del modelo Foto que maneja URLs externas y locales
     */
    public function getImagenPrincipalAttribute()
    {
        $primeraFoto = $this->fotos()->first();
        
        if ($primeraFoto) {
            return $primeraFoto->url;
        }
        
        return asset('assets/img/vacation-default.jpg');
    }


    //METODO QUE ME HACE FALTA PARA BORRAR LAS FOTOS ASOCIADAS CUANDO SE ELIMINA UN PAQUETE
    protected static function booted()
    {
        static::deleting(function ($vacacion) {
            // Eliminar todas las fotos asociadas
            foreach ($vacacion->fotos as $foto) {
                $foto->delete();
            }
        });
    }
}