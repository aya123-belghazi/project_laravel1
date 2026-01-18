<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActeursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('acteurs')->insert([
            [
                'nom' => 'DiCaprio',
                'prenom' => 'Leonardo',
                'pays' => 'USA',
                'date_naissance' => '1974-11-11',
                'tel' => null,
            ],
            [
                'nom' => 'Bogart',
                'prenom' => 'Humphrey',
                'pays' => 'USA',
                'date_naissance' => '1899-12-25',
                'tel' => '0123456789',
            ]
        ]);
    }
}
