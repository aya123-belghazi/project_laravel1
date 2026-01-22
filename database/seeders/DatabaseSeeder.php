<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Client;
use App\Models\Commande;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    // 1. Créer 20 produits
        $produits = Produit::factory(20)->create();

        // 2. Créer 10 clients
        Client::factory(10)->create()->each(function ($client) use ($produits) {

            // Pour chaque client, créer entre 1 et 3 commandes
            Commande::factory(rand(1, 3))->create([
                'client_id' => $client->id
            ])->each(function ($commande) use ($produits) {

                // 3. Pour chaque commande, attacher des produits (Table Pivot)
                // On prend 1 à 4 produits au hasard parmi la liste créée plus haut
                $produitsAleatoires = $produits->random(rand(1, 4));

                foreach ($produitsAleatoires as $produit) {
                    // attach() remplit la table 'commande_produit'
                    $commande->produits()->attach($produit->id, [
                        'qte_cmd' => rand(1, 10) // Quantité commandée aléatoire
                    ]);
                }
            });
        });
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
