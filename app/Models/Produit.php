<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'qte_stock', 'prix'];

    public function commandes() {
        return $this->belongsToMany(Commande::class)
                    ->withPivot('qte_cmd'); // Important pour accéder à la quantité
    }
}
