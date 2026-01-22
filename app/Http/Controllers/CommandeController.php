<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Commande::with('client', 'produits'); // Eager loading pour les relations

    // Recherche par client [cite: 23]
    if ($request->has('search_client')) {
        $search = $request->get('search_client');
        $query->whereHas('client', function($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%");
        });
    }

    $commandes = $query->paginate(10); // Pagination de 10 [cite: 15]

    // Si une commande est sélectionnée pour affichage détails
    $selectedCommande = null;
    if ($request->has('commande_id')) {
        $selectedCommande = Commande::with('produits')->find($request->commande_id);
    }

    return view('commandes.index', compact('commandes', 'selectedCommande'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validation [cite: 19]
    $validated = $request->validate([
        'client_id' => 'required|exists:clients,id',
        'date' => 'required|date',
        'produits' => 'required|array', // Tableau d'IDs produits
        'quantites' => 'required|array', // Tableau correspondant aux quantités
    ]);

    $commande = Commande::create([
        'client_id' => $validated['client_id'],
        'date' => $validated['date']
    ]);

    // Attacher les produits avec leurs quantités [cite: 7]
    foreach ($request->produits as $index => $produit_id) {
        $commande->produits()->attach($produit_id, ['qte_cmd' => $request->quantites[$index]]);
    }

    return redirect()->route('commandes.index')->with('success', 'Commande créée !');
}

public function stats()
{
    // Nombre de commandes par client
    $commandesParClient = Client::withCount('commandes')->get();

    // Chiffre d'affaires par produit (Prix * Quantité vendue)
    // Nécessite une jointure ou une boucle, voici une version SQL brute via Eloquent :
    $caParProduit = Produit::join('commande_produit', 'produits.id', '=', 'commande_produit.produit_id')
        ->selectRaw('produits.nom, sum(produits.prix * commande_produit.qte_cmd) as chiffre_affaires')
        ->groupBy('produits.nom')
        ->get();

    return view('commandes.stats', compact('commandesParClient', 'caParProduit'));
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
