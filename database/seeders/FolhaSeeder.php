<?php

namespace Database\Seeders;

use App\Models\Entidade;
use App\Models\Evento;
use App\Models\Folha;
use App\Models\RelFolhaFuncionario;
use App\Models\RelFolhaFuncionarioEvento;
use Illuminate\Database\Seeder;

class FolhaSeeder extends Seeder
{
    public function run()
    {
        $eventos = Evento::all();
        $entidades = Entidade::with('funcionarios')->get();

        if ($entidades->isEmpty()) {
            $this->command->error('Nenhuma entidade encontrada.');

            return;
        }

        // Criar folhas para os primeiros 6 meses de 2025
        foreach (range(1, 6) as $mes) {
            $folha = Folha::factory()->create([
                'mes' => $mes,
                'ano' => 2025,
            ]);

            // Para cada entidade, adicionar seus funcionários na folha
            $entidades->each(function ($entidade) use ($folha, $eventos) {
                $funcionarios = $entidade->funcionarios;

                if ($funcionarios->isEmpty()) {
                    return;
                }

                // Adiciona todos os funcionários da entidade (ou uma porcentagem aleatória)
                $funcionariosSelecionados = $funcionarios->random(
                    min($funcionarios->count(), rand(ceil($funcionarios->count() * 0.7), $funcionarios->count()))
                );

                foreach ($funcionariosSelecionados as $funcionario) {
                    $folhaItem = RelFolhaFuncionario::factory()->create([
                        'folha_id' => $folha->id,
                        'funcionario_id' => $funcionario->id,
                    ]);

                    // Adiciona eventos para cada funcionário
                    foreach ($eventos->random(rand(3, $eventos->count())) as $evento) {
                        RelFolhaFuncionarioEvento::factory()->create([
                            'folha_item_id' => $folhaItem->id,
                            'evento_id' => $evento->id,
                        ]);
                    }
                }
            });

            $this->command->info("Folha {$mes}/2025 criada com funcionários de todas as entidades.");
        }
    }
}
