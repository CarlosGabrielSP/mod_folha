<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Lotacao;
use App\Models\Situacao;
use App\Models\Vinculo;
use Illuminate\Database\Seeder;

class BaseTablesSeeder extends Seeder
{
    public function run()
    {
        Cargo::factory()->count(10)->create();

        $situacoes = [
            ['nome' => 'Ativo', 'descricao' => 'Funcionário ativo'],
            ['nome' => 'Desligado', 'descricao' => 'Funcionário desligado'],
            ['nome' => 'Inativo', 'descricao' => 'Funcionário inativo'],
            ['nome' => 'Aposentado', 'descricao' => 'Funcionário aposentado'],
        ];
        Situacao::insert($situacoes);

        $vinculos = [
            ['nome' => 'Ativo', 'descricao' => 'Funcionário ativo'],
            ['nome' => 'Desligado', 'descricao' => 'Funcionário desligado'],
            ['nome' => 'Inativo', 'descricao' => 'Funcionário inativo'],
            ['nome' => 'Aposentado', 'descricao' => 'Funcionário aposentado'],
        ];
        Vinculo::insert($vinculos);

        Lotacao::factory()->count(6)->create();
    }
}
