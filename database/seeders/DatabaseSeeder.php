<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage; 

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('pdfs');
        Storage::disk('public')->deleteDirectory('caratulas');

        Storage::disk('public')->makeDirectory('pdfs');
        Storage::disk('public')->makeDirectory('caratulas');
        
        $this->call([
            CarreraSeeder::class,
            TipoInformeSeeder::class,
            AutorSeeder::class,
            InformeSeeder::class,
            AutorInformeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
