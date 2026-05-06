<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
