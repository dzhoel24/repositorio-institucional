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

    // 👈 Accessor para el slug del tipo
    protected $appends = ['tipo_slug'];  // Agregar al array de appends

    public function getTipoSlugAttribute(): string
    {
        return match ($this->tipo_informe_id) {
            1 => 'modulo',
            3 => 'investigacion',
            4 => 'feria',
            default => 'institucional'
        };
    }

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

    public function getAutoresFormattedAttribute()
    {
        $autores = $this->relationLoaded('autores')
            ? $this->autores
            : (is_string($this->autores) ? json_decode(html_entity_decode($this->autores), true) : $this->autores);


        $autores = collect($autores);

        $nombres = $autores->map(function ($autor) {
            if (is_object($autor)) {
                return trim(($autor->nombres ?? '') . ' ' . ($autor->apellidos ?? ''));
            }
            return trim(($autor['nombres'] ?? '') . ' ' . ($autor['apellidos'] ?? ''));
        })->filter();

        return $nombres->isNotEmpty() ? $nombres->implode(', ') : 'Sin autores';
    }
}
