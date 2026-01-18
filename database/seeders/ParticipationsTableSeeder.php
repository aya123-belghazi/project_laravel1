<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('participations')->insert([
            [
                'films_id' => 1, // Inception
                'acteur_id' => 1, // DiCaprio
                'role' => 'Dom Cobb',
                'typeRole' => 'principal'
            ],
            [
                'films_id' => 2, // Casablanca
                'acteur_id' => 2, // Bogart
                'role' => 'Rick Blaine',
                'typeRole' => 'principal'
            ]
        ]);
    }
}
