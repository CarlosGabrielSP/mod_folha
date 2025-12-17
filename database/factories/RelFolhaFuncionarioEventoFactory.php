<?php

namespace Database\Factories;

use App\Models\Evento;
use App\Models\RelFolhaFuncionario;
use App\Models\RelFolhaFuncionarioEvento;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelFolhaFuncionarioEventoFactory extends Factory
{
    protected $model = RelFolhaFuncionarioEvento::class;

    public function definition()
    {
        return [
            'folha_item_id' => RelFolhaFuncionario::factory(),
            'evento_id' => Evento::factory(),
            'valor' => $this->faker->randomFloat(2, 50, 1500),
        ];
    }
}
