<?php

namespace Database\Seeders;

use App\Models\Entidade;
use App\Models\Funcionario;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    public function run()
    {
        // Pega todas as entidades
        $entidades = Entidade::all();

        if ($entidades->isEmpty()) {
            $this->command->error('Nenhuma entidade encontrada. Execute EntidadeSeeder primeiro.');

            return;
        }

        // Distribui funcionários entre as entidades
        $entidades->each(function ($entidade) {
            // Cada entidade terá entre 5 e 15 funcionários
            $quantidade = rand(5, 15);

            Funcionario::factory()
                ->count($quantidade)
                ->create([
                    'entidade_id' => $entidade->id,
                ]);
        });

        $this->command->info('Funcionários criados e distribuídos entre as entidades.');
    }
}
