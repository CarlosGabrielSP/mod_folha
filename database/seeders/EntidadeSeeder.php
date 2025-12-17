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
        // Criar entidades específicas
        Entidade::create([
            'nome' => 'Prefeitura Municipal de São Paulo',
            'slug' => Str::slug('Prefeitura Municipal de São Paulo'),
            'cnpj' => '46.395.000/0001-39',
            'uf' => 'SP',
            'municipio' => 'São Paulo',
            'cep' => '01310100',
            'logradouro' => 'Viaduto do Chá, 15',
            'bairro' => 'Centro',
            'telefone' => '(11) 3113-9000',
            'email' => 'contato@prefeitura.sp.gov.br',
            'site' => 'www.capital.sp.gov.br',
            'logo' => 'logos/sp.png',
        ]);

        Entidade::create([
            'nome' => 'Câmara Municipal de São Paulo',
            'slug' => Str::slug('Câmara Municipal de São Paulo'),
            'cnpj' => '59.208.421/0001-34',
            'uf' => 'SP',
            'municipio' => 'São Paulo',
            'cep' => '01310200',
            'logradouro' => 'Viaduto Jacareí, 100',
            'bairro' => 'Bela Vista',
            'telefone' => '(11) 3396-4000',
            'email' => 'contato@camara.sp.gov.br',
            'site' => 'www.saopaulo.sp.leg.br',
            'logo' => 'logos/camara_sp.png',
        ]);

        Entidade::create([
            'nome' => 'Prefeitura Municipal do Rio de Janeiro',
            'slug' => Str::slug('Prefeitura Municipal do Rio de Janeiro'),
            'cnpj' => '42.498.733/0001-48',
            'uf' => 'RJ',
            'municipio' => 'Rio de Janeiro',
            'cep' => '20031170',
            'logradouro' => 'Rua Afonso Cavalcanti, 455',
            'bairro' => 'Centro',
            'telefone' => '(21) 2976-1000',
            'email' => 'contato@rio.rj.gov.br',
            'site' => 'www.rio.rj.gov.br',
            'logo' => 'logos/rio.png',
        ]);

        // Criar entidades aleatórias adicionais
        Entidade::factory(5)->create();
    }
}
