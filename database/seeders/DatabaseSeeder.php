<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CarreraSeeder::class,
            AutorSeeder::class,
            TipoInformeSeeder::class,
            InformeSeeder::class,
            AutorInformeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
