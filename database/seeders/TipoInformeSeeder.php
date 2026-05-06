<?php

namespace Database\Seeders;

use App\Models\TipoInforme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoInformeSeeder extends Seeder
{

    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Modular'],
            ['nombre' => 'Proyecto de Titulacion'],
            ['nombre' => 'Proyecto de Investigacion'],
            ['nombre' => 'Proyecto de Feria Tecnologica'],
        ];

        foreach ($tipos as $tipo) {
            TipoInforme::create($tipo);
        }
    }
}
