<?php

namespace Database\Factories;

use App\Models\Autor;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutorFactory extends Factory
{
    protected $model = Autor::class;

    public function definition()
    {
        return [
            'dni' => fake()->unique()->numerify('########'),
            'nombres' => fake()->firstName() . ' ' . fake()->firstName(),
            'apellidos' => fake()->lastName() . ' ' . fake()->lastName(),
        ];
    }
}
