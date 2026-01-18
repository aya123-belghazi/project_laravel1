<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'titre' => fake()->sentence(3), // Titre de 3 mots
        'pays' => fake()->country(),
        'annee' => fake()->year(),
        'duree' => fake()->time(),
        'genre' => fake()->word(),
        ];
    }
}
