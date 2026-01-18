<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Film;
use App\Models\Acteur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participation>
 */
class ParticipationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'films_id' => Film::factory(),
        'acteur_id' => Acteur::factory(),
        'role' => fake()->name(), // Nom du personnage
        'typeRole' => fake()->randomElement(['principal', 'secondaire']),
        ];
    }
}
