<?php

namespace Database\Factories;

use App\Models\Folha;
use App\Models\Funcionario;
use App\Models\RelFolhaFuncionario;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelFolhaFuncionarioFactory extends Factory
{
    protected $model = RelFolhaFuncionario::class;

    public function definition()
    {
        $proventos = $this->faker->randomFloat(2, 2000, 8000);
        $descontos = $this->faker->randomFloat(2, 200, 2000);

        return [
            'folha_id' => Folha::factory(),
            'funcionario_id' => Funcionario::factory(),
            'referencia' => $this->faker->randomElement([
                'Mensal', 'Recisão', 'Férias', '13º Salário',
            ]),
            'total_proventos' => $proventos,
            'total_descontos' => $descontos,
            'total_liquido' => $proventos - $descontos,
        ];
    }
}
