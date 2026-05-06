<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\AutorInforme;
use App\Models\Informe;
use Illuminate\Database\Seeder;

class AutorInformeSeeder extends Seeder
{
    public function run()
    {
        $autores = Autor::all();
        if ($autores->isEmpty()) {
            throw new \Exception("No hay autores disponibles para relacionar.");
        }
        $informes = Informe::all();
        if ($informes->isEmpty()) {
            throw new \Exception("No hay informes disponibles para relacionar.");
        }
        foreach ($informes as $informe) {
            $randomAutors = $autores->random(rand(1, 3));
            
            foreach ($randomAutors as $autor) {
                if ($autor->dni) {
                    AutorInforme::create([
                        'autor_dni' => $autor->dni,
                        'informe_id' => $informe->id,
                    ]);
                }
            }
        }
    }
}



