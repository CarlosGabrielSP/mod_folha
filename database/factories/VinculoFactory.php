<?php

namespace Database\Factories;

use App\Models\Vinculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class VinculoFactory extends Factory
{
    protected $model = Vinculo::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->randomElement([
                'Efetivo', 'Comissionado', 'Temporário', 'Estagiário',
            ]),
            'descricao' => $this->faker->sentence(),
        ];
    }
}
