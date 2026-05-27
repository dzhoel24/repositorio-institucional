<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'full_name' => 'Joel Eduardo Flores Barahona',
            'username' => 'Joel',
            'password' => bcrypt('123456'),
            'profile_photo' => 'foto-profile.jpg',
        ]);
    }
}
