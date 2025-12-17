<?php

namespace Database\Factories;

use App\Models\Folha;
use Illuminate\Database\Eloquent\Factories\Factory;

class FolhaFactory extends Factory
{
    protected $model = Folha::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'mes' => $this->faker->numberBetween(1, 12),
            'ano' => $this->faker->numberBetween(2020, 2025),
        ];
    }
}
