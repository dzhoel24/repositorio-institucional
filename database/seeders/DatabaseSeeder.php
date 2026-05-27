<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
