<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'id_vacacion'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function vacacion()
    {
        return $this->belongsTo(Vacacion::class, 'id_vacacion');
    }
}