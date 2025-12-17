<?php

namespace Database\Seeders;

use App\Models\Evento;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventos = [
            // PROVENTOS
            ['nome' => 'SALÁRIO BASE', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'GRATIFICAÇÃO', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'HORA EXTRA', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'ADICIONAL NOTURNO', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'ADICIONAL INSALUBRIDADE', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'ADICIONAL PERICULOSIDADE', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'FÉRIAS', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => '1/3 FÉRIAS', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => '13º SALÁRIO', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'AUXÍLIO ALIMENTAÇÃO', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'AUXÍLIO TRANSPORTE', 'referencia_tipo' => 'PROVENTO'],
            ['nome' => 'VALE REFEIÇÃO', 'referencia_tipo' => 'PROVENTO'],

            // DESCONTOS
            ['nome' => 'FALTAS', 'referencia_tipo' => 'DESCONTO'],
            ['nome' => 'IRRF', 'referencia_tipo' => 'DESCONTO'],
            ['nome' => 'INSS', 'referencia_tipo' => 'DESCONTO'],
            ['nome' => 'EMPRÉSTIMO CONSIGNADO', 'referencia_tipo' => 'DESCONTO'],
            ['nome' => 'PENSÃO ALIMENTÍCIA', 'referencia_tipo' => 'DESCONTO'],
            ['nome' => 'PLANO DE SAÚDE', 'referencia_tipo' => 'DESCONTO'],
            ['nome' => 'VALE TRANSPORTE', 'referencia_tipo' => 'DESCONTO'],
            ['nome' => 'CONTRIBUIÇÃO SINDICAL', 'referencia_tipo' => 'DESCONTO'],
            ['nome' => 'ADIANTAMENTO SALARIAL', 'referencia_tipo' => 'DESCONTO'],
        ];

        foreach ($eventos as $evento) {
            Evento::updateOrCreate(
                ['nome' => $evento['nome']],
                $evento
            );
        }
    }
}
