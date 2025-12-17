<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Entidade;
use App\Models\Funcionario;
use App\Models\Lotacao;
use App\Models\Situacao;
use App\Models\Vinculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionarioFactory extends Factory
{
    protected $model = Funcionario::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'entidade_id' => Entidade::inRandomOrder()->first()?->id ?? Entidade::factory(),
            'nome' => $this->faker->name(),
            'matricula' => strtoupper($this->faker->unique()->bothify('MAT#####')),
            'cpf' => $this->faker->numerify('###########'),
            'cargo_id' => Cargo::inRandomOrder()->first()?->id ?? Cargo::factory(),
            'data_admissao' => $this->faker->date(),
            'data_demissao' => null,
            'email' => $this->faker->safeEmail(),
            'telefone' => $this->faker->phoneNumber(),
            'id_lotacoes' => Lotacao::inRandomOrder()->first()?->id ?? Lotacao::factory(),
            'id_vinculos' => Vinculo::inRandomOrder()->first()?->id ?? Vinculo::factory(),
            'id_situacoes' => Situacao::inRandomOrder()->first()?->id ?? Situacao::factory(),
        ];
    }
}
