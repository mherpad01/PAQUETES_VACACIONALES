<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['id_vacacion', 'ruta'];

    public function vacacion()
    {
        return $this->belongsTo(Vacacion::class, 'id_vacacion');
    }


    //Meto una serie de cambios que quería porque para hacer un seeder con fotos, quería que fueran por
    //URL, y entonces había que hacer que las soportaran.

    /*

        public function getUrlAttribute()
    {
        return asset('storage/' . $this->ruta);
    }

    // Eliminar archivo al borrar registro
    protected static function booted()
    {
        static::deleting(function ($foto) {
            if (Storage::disk('public')->exists($foto->ruta)) {
                Storage::disk('public')->delete($foto->ruta);
            }
        });
    }


    public function getUrlCompletaAttribute()
    {
        return asset('storage/' . $this->ruta);
    }



    */

        /**
     * Obtener la URL de la foto
     * Detecta si es una URL externa o una ruta local
     */
    public function getUrlAttribute()
    {
        // Si la ruta empieza con http:// o https://, es una URL externa
        if (filter_var($this->ruta, FILTER_VALIDATE_URL)) {
            return $this->ruta;
        }
        
        // Si no, es una ruta local en storage
        return asset('storage/' . $this->ruta);
    }

    /**
     * Alias para getUrlAttribute
     */
    public function getUrlCompletaAttribute()
    {
        return $this->url;
    }

    /**
     * Verificar si la foto es una URL externa
     */
    public function esUrlExterna()
    {
        return filter_var($this->ruta, FILTER_VALIDATE_URL);
    }

    // Eliminar archivo al borrar registro (solo si es local)
    protected static function booted()
    {
        static::deleting(function ($foto) {
            // Solo intentar eliminar si NO es una URL externa
            if (!$foto->esUrlExterna() && Storage::disk('public')->exists($foto->ruta)) {
                Storage::disk('public')->delete($foto->ruta);
            }
        });
    }
}