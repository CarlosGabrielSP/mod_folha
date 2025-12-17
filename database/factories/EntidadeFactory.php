<?php

namespace Database\Factories;

use App\Models\Entidade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entidade>
 */
class EntidadeFactory extends Factory
{
    protected $model = Entidade::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ufs = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];

        $tiposEntidade = [
            'Prefeitura Municipal de ',
            'Câmara Municipal de ',
            'Secretaria Municipal de ',
            'Autarquia Municipal de ',
            'Fundação Municipal de ',
        ];

        $municipio = fake()->city();
        $tipo = fake()->randomElement($tiposEntidade);
        $nome = $tipo.$municipio;

        return [
            'nome' => $nome,
            'slug' => Str::slug($nome),
            'cnpj' => $this->generateCNPJ(),
            'uf' => fake()->randomElement($ufs),
            'municipio' => $municipio,
            'cep' => fake()->numerify('########'),
            'logradouro' => fake()->streetAddress(),
            'bairro' => fake()->streetName(),
            'telefone' => fake()->numerify('(##) ####-####'),
            'email' => fake()->unique()->safeEmail(),
            'site' => fake()->domainName(),
            'logo' => fake()->imageUrl(200, 200, 'business', true, $municipio),
        ];
    }

    /**
     * Gera um CNPJ válido
     */
    private function generateCNPJ(): string
    {
        $n1 = rand(0, 9);
        $n2 = rand(0, 9);
        $n3 = rand(0, 9);
        $n4 = rand(0, 9);
        $n5 = rand(0, 9);
        $n6 = rand(0, 9);
        $n7 = rand(0, 9);
        $n8 = rand(0, 9);
        $n9 = 0;
        $n10 = 0;
        $n11 = 0;
        $n12 = 1;

        $d1 = $n12 * 2 + $n11 * 3 + $n10 * 4 + $n9 * 5 + $n8 * 6 + $n7 * 7 + $n6 * 8 + $n5 * 9 + $n4 * 2 + $n3 * 3 + $n2 * 4 + $n1 * 5;
        $d1 = 11 - ($d1 % 11);
        if ($d1 >= 10) {
            $d1 = 0;
        }

        $d2 = $d1 * 2 + $n12 * 3 + $n11 * 4 + $n10 * 5 + $n9 * 6 + $n8 * 7 + $n7 * 8 + $n6 * 9 + $n5 * 2 + $n4 * 3 + $n3 * 4 + $n2 * 5 + $n1 * 6;
        $d2 = 11 - ($d2 % 11);
        if ($d2 >= 10) {
            $d2 = 0;
        }

        return sprintf(
            '%d%d.%d%d%d.%d%d%d/%d%d%d%d-%d%d',
            $n1, $n2, $n3, $n4, $n5, $n6, $n7, $n8, $n9, $n10, $n11, $n12, $d1, $d2
        );
    }
}
