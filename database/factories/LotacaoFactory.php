<?php

namespace Database\Factories;

use App\Models\Lotacao;
use Illuminate\Database\Eloquent\Factories\Factory;

class LotacaoFactory extends Factory
{
    protected $model = Lotacao::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->company(),
            'codigo' => strtoupper($this->faker->bothify('LOT-###')),
            'endereco' => $this->faker->address(),
        ];
    }
}
