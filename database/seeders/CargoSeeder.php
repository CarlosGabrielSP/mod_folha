<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserir alguns cargos comuns
        $cargos = [
            [
                'nome' => 'Diretor',
                'referencia' => 'D-1',
                'carga_horaria' => '40h',
                'salario_base' => '8000.00',
            ],
            [
                'nome' => 'Coordenador',
                'referencia' => 'C-1',
                'carga_horaria' => '40h',
                'salario_base' => '6000.00',
            ],
            [
                'nome' => 'Analista',
                'referencia' => 'A-1',
                'carga_horaria' => '40h',
                'salario_base' => '4500.00',
            ],
            [
                'nome' => 'Assistente',
                'referencia' => 'A-2',
                'carga_horaria' => '40h',
                'salario_base' => '3000.00',
            ],
            [
                'nome' => 'Estagiário',
                'referencia' => 'E-1',
                'carga_horaria' => '30h',
                'salario_base' => '1500.00',
            ],
        ];

        foreach ($cargos as $cargo) {
            Cargo::create($cargo);
        }

        // Criar mais alguns cargos usando a factory
        Cargo::factory(10)->create();
    }
}
