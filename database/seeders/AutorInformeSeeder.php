<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\Informe;
use Illuminate\Database\Seeder;

class AutorInformeSeeder extends Seeder
{
    public function run(): void
    {
        $autores  = Autor::all();
        $informes = Informe::all();

        if ($autores->isEmpty()) throw new \Exception("No hay autores.");
        if ($informes->isEmpty()) throw new \Exception("No hay informes.");

        foreach ($informes as $informe) {
            $informe->autores()->attach(
                $autores->random(rand(1, 3))->pluck('dni')->toArray()
            );
        }
    }
}
