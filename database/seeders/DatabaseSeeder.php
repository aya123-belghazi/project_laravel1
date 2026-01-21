<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Créer des clients et des produits
        $clients = Client::factory(10)->create();
        $produits = Produit::factory(20)->create();

        // 2. Pour chaque client, créer une commande
        $clients->each(function ($client) use ($produits) {

            $commande = Commande::create([
                'client_id' => $client->id,
                'date' => now(), // Assure-toi que 'date' est dans $fillable du modèle Commande
            ]);

            // 3. Attacher des produits (Table Pivot)
            // On prend 2 IDs de produits au hasard et on les transforme en tableau simple
            $produitsIds = $produits->random(2)->pluck('id')->toArray();

            // On attache ces IDs avec une quantité aléatoire
            $commande->produits()->attach($produitsIds, ['qte_cmd' => rand(1, 5)]);
        });
    }
}
