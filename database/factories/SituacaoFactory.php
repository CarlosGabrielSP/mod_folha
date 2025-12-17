<?php

namespace Database\Factories;

use App\Models\Situacao;
use Illuminate\Database\Eloquent\Factories\Factory;

class SituacaoFactory extends Factory
{
    protected $model = Situacao::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->randomElement([
                'Ativo', 'Desligado', 'Inativo', 'Aposentado',
            ]),
            'descricao' => $this->faker->sentence(),
        ];
    }
}
