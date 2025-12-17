<?php

namespace Database\Factories;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    protected $model = Cargo::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->jobTitle(),
            'referencia' => $this->faker->optional()->regexify('[A-Z]-[0-9]'),
            'carga_horaria' => $this->faker->optional()->randomElement(['20h', '30h', '40h']),
            'salario_base' => $this->faker->optional()->randomFloat(2, 1000, 10000),
        ];
    }
}
