<?php

namespace App\Models;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;
    protected $table = 'informe';

    public function tipoInforme()
    {
        return $this->belongsTo(TipoInforme::class, 'tipo_informe_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    public function autores()
    {
        return $this->belongsToMany(
            Autor::class,
            'autor_informe',
            'informe_id',
            'autor_dni'
        );
    }

    protected $fillable = [
        'titulo',
        'anio',
        'ruta_pdf',
        'ruta_caratula',
        'modulo',
        'estado',
        'acceso',
        'tipo_informe_id',
        'carrera_id',
    ];
    public function scopeFilter(Builder $query, Request $request)
    {
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('titulo', 'like', "%$searchTerm%")
                    ->orWhere('resumen', 'like', "%$searchTerm%")
                    ->orWhereHas('autores', function ($q) use ($searchTerm) {
                        $q->where('nombres', 'like', "%$searchTerm%")
                            ->orWhere('apellidos', 'like', "%$searchTerm%");
                    });
            });
        }

        return $query;
    }

    // app/Models/Informe.php
    public function getAutoresFormattedAttribute()
    {
        // Si es una relación
        if ($this->relationLoaded('autores')) {
            return $this->autores->map(function ($autor) {
                return $autor->nombres . ' ' . $autor->apellidos;
            })->implode(', ');
        }

        // Si es un array directo
        if (is_array($this->autores)) {
            return collect($this->autores)->map(function ($autor) {
                $nombre = $autor['nombres'] ?? '';
                $apellido = $autor['apellidos'] ?? '';
                return trim("$nombre $apellido");
            })->implode(', ');
        }

        // Si es JSON string
        if (is_string($this->autores)) {
            $autores = json_decode(html_entity_decode($this->autores), true);
            return collect($autores)->map(function ($autor) {
                return trim(($autor['nombres'] ?? '') . ' ' . ($autor['apellidos'] ?? ''));
            })->implode(', ');
        }

        return 'Sin autores';
    }
}
