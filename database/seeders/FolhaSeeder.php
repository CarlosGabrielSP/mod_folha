<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Entidade;
use App\Models\Folha;
use Illuminate\Database\Seeder;

class FolhaSeeder extends Seeder
{
    public function run()
    {
        $entidades = Entidade::all();
        $cargos = Cargo::all();

        if ($entidades->isEmpty()) {
            $this->command->error('Nenhuma entidade encontrada.');
            return;
        }

        if ($cargos->isEmpty()) {
            $this->command->error('Nenhum cargo encontrado.');
            return;
        }

        // Criar folhas para os primeiros 6 meses de 2025
        foreach (range(1, 1000) as $index) {
            $entidade = $entidades->random();
            $cargo = $cargos->random();

            $proventos = fake()->randomFloat(2, 3000, 12000);
            $descontos = fake()->randomFloat(2, 300, 2500);

            Folha::create([
                'mes' => fake()->numberBetween(1, 12),
                'ano' => 2025,
                'referencia' => 'mensal',
                'matricula' => strtoupper(fake()->bothify('MAT#####')),
                'funcionario' => fake()->name(),
                'situacao' => 'ativo',
                'lotacao' => fake()->optional()->company(),
                'vinculo' => fake()->randomElement(['estatutario', 'contratado', 'comissionado', 'temporario', 'estagiario']),
                'total_proventos' => $proventos,
                'total_descontos' => $descontos,
                'total_liquido' => $proventos - $descontos,
                'cargo_id' => $cargo->id,
                'entidade_id' => $entidade->id,
            ]);
        }

        // Criar algumas folhas adicionais com a factory
        // Folha::factory(1000)->create();

        $this->command->info('1000 folhas adicionais criadas com factory.');
    }
}
