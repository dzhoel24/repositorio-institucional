<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';
    protected $primaryKey = 'dni';

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'dni',
        'nombres',
        'apellidos'
    ];

    // RELACION INFORMES 
    public function informes()
    {
        return $this->belongsToMany(
            Informe::class,
            'autor_informe',
            'autor_dni',
            'informe_id'
        );
    }

    // SCOPE DE BÚSQUEDA
    public function scopeFilter($query, $request)
    {
        $search = strtolower($request->input('buscador'));

        return $query->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->whereRaw('LOWER(dni) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(nombres) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(apellidos) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw("LOWER(CONCAT(nombres, ' ', apellidos)) LIKE ?", ["%{$search}%"]);
            });
        });
    }
}
