<?php

namespace Database\Seeders;

use App\Models\TipoInforme;
use Illuminate\Database\Seeder;

class TipoInformeSeeder extends Seeder
{

    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Modular'],
            ['nombre' => 'Titulacion'],
            ['nombre' => 'Investigacion'],
            ['nombre' => 'Feria Tecnologica'],
        ];

        foreach ($tipos as $tipo) {
            TipoInforme::create($tipo);
        }
    }
}
