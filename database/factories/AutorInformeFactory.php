<?php

namespace Database\Factories;

use App\Models\Autor;
use App\Models\AutorInforme;
use App\Models\Informe;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutorInformeFactory extends Factory
{
    protected $model = AutorInforme::class;

    public function definition()
    {
        return [
            'autor_dni' => Autor::factory()->create()->dni,
            'informe_id' => Informe::factory()->create()->id,
        ];
    }
}
