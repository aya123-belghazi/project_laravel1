<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('films')->insert([
            [
                'titre' => 'Inception',
                'pays' => 'USA',
                'annee' => 2010,
                'duree' => '02:28:00',
                'genre' => 'Science Fiction',
            ],
            [
                'titre' => 'Casablanca',
                'pays' => 'USA',
                'annee' => 1942,
                'duree' => '01:42:00',
                'genre' => 'Drame',
            ]
        ]);
    }
}
