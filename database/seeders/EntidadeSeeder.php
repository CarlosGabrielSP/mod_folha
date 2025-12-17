<?php

namespace Database\Seeders;

use App\Models\Entidade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar entidades aleatórias adicionais
        Entidade::factory(5)->create();
    }
}
