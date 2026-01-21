<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'client_id'];

    // Relation : Une commande appartient à un seul client [cite: 20]
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relation : Une commande contient plusieurs produits (via la table pivot) [cite: 7]
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
                    ->withPivot('qte_cmd'); // Indispensable pour récupérer la quantité
    }
}
