<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Entidade;
use App\Models\Folha;
use Illuminate\Database\Eloquent\Factories\Factory;

class FolhaFactory extends Factory
{
    protected $model = Folha::class;

    public function definition()
    {
        $proventos = $this->faker->randomFloat(2, 2000, 10000);
        $descontos = $this->faker->randomFloat(2, 200, 2000);

        return [
            'id' => $this->faker->uuid(),
            'mes' => $this->faker->numberBetween(1, 12),
            'ano' => $this->faker->numberBetween(2020, 2025),
            'referencia' => $this->faker->randomElement(['mensal', 'ferias', 'decimo_terceiro', 'rescisao']),
            'matricula' => strtoupper($this->faker->unique()->bothify('MAT#####')),
            'funcionario' => $this->faker->name(),
            'situacao' => $this->faker->randomElement(['ativo', 'inativo', 'desligado', 'aposentado']),
            'lotacao' => $this->faker->optional()->company(),
            'vinculo' => $this->faker->optional()->randomElement(['estatutario', 'comissionado', 'contratado', 'temporario', 'estagiario']),
            'total_proventos' => $proventos,
            'total_descontos' => $descontos,
            'total_liquido' => $proventos - $descontos,
            'cargo_id' => Cargo::inRandomOrder()->first()?->id ?? Cargo::factory(),
            'entidade_id' => Entidade::inRandomOrder()->first()?->id ?? Entidade::factory(),
        ];
    }
}
