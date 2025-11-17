<?php

namespace Database\Factories;

use App\Models\Produktu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produktu>
 */
class ProduktuFactory extends Factory
{
    protected $model = Produktu::class;

    public function definition(): array
    {
        return [
            'izena' => $this->faker->unique()->words(asText: true),
            'deskribapena' => $this->faker->sentence(),
            'prezioa' => $this->faker->randomFloat(2, 1, 200),
        ];
    }
}
