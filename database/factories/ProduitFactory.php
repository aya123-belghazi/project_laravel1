<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
        'nom' => $this->faker->words(2, true), // Nom de produit (ex: "Chaise bureau")
        'qte_stock' => $this->faker->numberBetween(0, 100),
        'prix' => $this->faker->randomFloat(2, 10, 500), // Prix entre 10 et 500 avec 2 décimales
    ];
    }
}
