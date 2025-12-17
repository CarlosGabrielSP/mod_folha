<?php

namespace Database\Factories;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{
    protected $model = Evento::class;

    public function definition()
    {
        $tipo = $this->faker->randomElement(['PROVENTO', 'DESCONTO']);

        return [
            'nome' => $tipo === 'PROVENTO'
                ? $this->faker->randomElement(['Salário Base', 'Gratificação', 'Hora Extra', 'Adicional Noturno'])
                : $this->faker->randomElement(['INSS', 'IRRF', 'Faltas', 'Vale Transporte']),
            'referencia_tipo' => $tipo,
        ];
    }
}
