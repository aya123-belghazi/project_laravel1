<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderController extends Controller
{
    public function index()
    {
        // --- EXERCICE 1 : SÉLECTION ---

        // 1. Tous les films
        $q1 = DB::table('films')->get();

        // 2. Juste les titres
        $q2 = DB::table('films')->select('titre')->get();

        // 3. Films après 2010 (on utilise 'annee' > 2010)
        $q3 = DB::table('films')->where('annee', '>', 2010)->select('titre', 'annee')->get();

        // 4. Acteurs commençant par "D"
        $q4 = DB::table('acteurs')->where('nom', 'like', 'D%')->get();

        // 5. Films > 120 minutes
        $q5 = DB::table('films')->where('duree', '>', '02:00:00')->get();


        // --- EXERCICE 2 : INSERTION ---

        // Insérer un film
        // Je commente pour ne pas l'ajouter à chaque fois que tu actualises la page
        /*
        DB::table('films')->insert([
            'titre' => 'Nouveau Film TP',
            'pays' => 'Maroc',
            'annee' => 2025,
            'duree' => '01:30:00',
            'genre' => 'Action'
        ]);
        */


        // --- EXERCICE 3 : MISE A JOUR ---

        // Modifier le titre du film avec l'ID 1
        /*
        DB::table('films')
            ->where('id', 1)
            ->update(['titre' => 'Titre Modifié']);
        */


        // --- EXERCICE 5 : AGRÉGATION ---

        // Nombre total de films
        $countFilms = DB::table('films')->count();

        // Moyenne des durées (Attention : AVG marche mieux sur des nombres, pour TIME c'est complexe, ici exemple sur année) \
        $avgAnnee = DB::table('films')->avg('annee');


        // --- EXERCICE 7 : JOINTURES ---

        // 1. Films avec noms des acteurs
        $joins = DB::table('participations')
            ->join('films', 'participations.films_id', '=', 'films.id')
            ->join('acteurs', 'participations.acteur_id', '=', 'acteurs.id')
            ->select('films.titre', 'acteurs.nom', 'acteurs.prenom')
            ->get();

        // 5. Acteurs sans films (Left Join) 
        $noMovies = DB::table('acteurs')
            ->leftJoin('participations', 'acteurs.id', '=', 'participations.acteur_id')
            ->whereNull('participations.films_id')
            ->get();


        // --- AFFICHAGE DES RÉSULTATS ---
        // On utilise dump() pour afficher les résultats proprement à l'écran
        return dd([
            'Q1 - Tous les films' => $q1,
            'Q3 - Films recents' => $q3,
            'Q4 - Acteurs en D' => $q4,
            'Nombre de films' => $countFilms,
            'Jointures' => $joins,
            'Acteurs sans films' => $noMovies
        ]);
    }
}
