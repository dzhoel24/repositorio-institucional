<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CarreraSeeder::class,
            TipoInformeSeeder::class,
            AutorSeeder::class,
            InformeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
