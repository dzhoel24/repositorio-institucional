<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Informe;

class InformeSeeder extends Seeder
{
    public function run(): void
    {
        Informe::factory()->count(100)->create();
    }
}
