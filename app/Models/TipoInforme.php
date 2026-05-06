<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInforme extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tipo',
    ];
    public $timestamps = false;
    protected $table = 'tipo_informe';
    public function informes()
    {
        return $this->hasMany(Informe::class, 'tipo_informe_id');
    }
}
