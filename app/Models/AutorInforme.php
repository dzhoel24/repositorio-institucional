<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutorInforme extends Model
{
    use HasFactory;
    protected $table = 'autor_informe';
    public $timestamps = false;
    protected $fillable = ['autor_dni', 'informe_id'];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_dni', 'dni');
    }

    public function informe()
    {
        return $this->belongsTo(Informe::class, 'informe_id', 'id');
    }
}
