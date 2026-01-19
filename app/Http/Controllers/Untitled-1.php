<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TpQueryController extends Controller
{
    public function index()
    {
        // Tableau pour stocker les résultats des tests de lecture
        $resultats = [];

        // ==========================================
        [cite_start]// EXERCICE 1 : SÉLECTION DE FILMS [cite: 5]
        // ==========================================

        // 1) Tous les films
        $resultats['Ex1_Q1_Tous'] = DB::table('films')->get();

        // 2) Titres de tous les films
        $resultats['Ex1_Q2_Titres'] = DB::table('films')->pluck('titre'); // pluck est plus propre que select pour une seule colonne

        // 3) Films après une date (ex: 2010) + affichage titre et date
        $resultats['Ex1_Q3_Recents'] = DB::table('films')
            ->where('annee', '>', 2010)
            ->select('titre', 'annee')
            ->get();

        // 4) Acteurs commençant par "D"
        $resultats['Ex1_Q4_Acteurs_D'] = DB::table('acteurs')
            ->where('nom', 'like', 'D%')
            ->get();

        // 5) Films > 120 minutes (02:00:00)
        $resultats['Ex1_Q5_Longs_Metrages'] = DB::table('films')
            ->where('duree', '>', '02:00:00')
            ->get();

        // 6) Films entre deux dates (ex: 2000 et 2020)
        $resultats['Ex1_Q6_Entre_Dates'] = DB::table('films')
            ->whereBetween('annee', [2000, 2020])
            ->get();


        // ==========================================
        [cite_start]// EXERCICE 2 : INSERTION [cite: 12]
        // ==========================================
        // Décommente les lignes ci-dessous pour tester l'insertion

        /*
        // 1) Insérer un seul film
        DB::table('films')->insert([
            'titre' => 'Joker',
            'pays' => 'USA',
            'annee' => 2019,
            'duree' => '02:02:00',
            'genre' => 'Drame'
        ]);

        // 2) Insérer plusieurs films
        DB::table('films')->insert([
            ['titre' => 'Matrix', 'pays' => 'USA', 'annee' => 1999, 'duree' => '02:16:00', 'genre' => 'SF'],
            ['titre' => 'Parasite', 'pays' => 'Corée', 'annee' => 2019, 'duree' => '02:12:00', 'genre' => 'Thriller']
        ]);
        */


        // ==========================================
        [cite_start]// EXERCICE 3 : MISE À JOUR [cite: 15]
        // ==========================================

        /*
        // 1) Modifier le titre d'un film (ex: ID 1)
        DB::table('films')->where('id', 1)->update(['titre' => 'Inception Director Cut']);

        // 2) Sélectionner puis mettre à jour (En Query Builder, on fait directement l'update avec where)
        DB::table('films')->where('titre', 'Matrix')->update([
            'titre' => 'The Matrix',
            'genre' => 'Science Fiction' // "description" n'existe pas dans ta table, j'utilise genre
        ]);

        // 3) Mettre à jour date films anciens (avant 2000 -> mis à 2000)
        DB::table('films')->where('annee', '<', 2000)->update(['annee' => 2000]);
        */


        // ==========================================
        [cite_start]// EXERCICE 4 : SUPPRESSION [cite: 19]
        // ==========================================

        /*
        // 1) Supprimer un film spécifique (ex: ID 5)
        DB::table('films')->where('id', 5)->delete();

        // 2) Supprimer films avant une date (ex: avant 1990)
        DB::table('films')->where('annee', '<', 1990)->delete();
        */


        // ==========================================
        [cite_start]// EXERCICE 5 : AGRÉGATION [cite: 22]
        // ==========================================

        // 1) Nombre total de films
        $resultats['Ex5_Q1_Total_Films'] = DB::table('films')->count();

        // 2) Moyenne des durées (Attention : sur SQL, avg sur TIME peut être bizarre, ici pour l'exemple)
        // Pour avoir un résultat lisible, on compte souvent en secondes, mais voici la syntaxe standard :
        $resultats['Ex5_Q2_Moyenne_Duree'] = DB::table('films')->avg('duree');

        // 3) Moyenne des années
        $resultats['Ex5_Q3_Moyenne_Annee'] = DB::table('films')->avg('annee');

        // 4) Nombre de films pour un acteur (ex: ID 1)
        $resultats['Ex5_Q4_Films_Acteur_1'] = DB::table('participations')
            ->where('acteur_id', 1)
            ->count();


        // ==========================================
        [cite_start]// EXERCICE 6 : PAGINATION [cite: 27]
        // ==========================================

        // 1) Pagination 10 par page
        // Note : Dans un dd(), tu verras l'objet Paginator, c'est normal.
        $resultats['Ex6_Pagination'] = DB::table('films')->paginate(10);

        // 2) Pour afficher la page 2, il suffit d'ajouter ?page=2 dans l'URL de ton navigateur.
        // Laravel gère ça automatiquement avec paginate().


        // ==========================================
        [cite_start]// EXERCICE 7 : JOINTURES [cite: 30]
        // ==========================================

        // 1) Films avec noms des acteurs
        $resultats['Ex7_Q1_Films_Acteurs'] = DB::table('participations')
            ->join('films', 'participations.films_id', '=', 'films.id')
            ->join('acteurs', 'participations.acteur_id', '=', 'acteurs.id')
            ->select('films.titre', 'acteurs.nom', 'acteurs.prenom')
            ->get();

        // 2) Acteurs ayant joué dans un film "Action"
        $resultats['Ex7_Q2_Acteurs_Action'] = DB::table('acteurs')
            ->join('participations', 'acteurs.id', '=', 'participations.acteur_id')
            ->join('films', 'participations.films_id', '=', 'films.id')
            ->where('films.genre', 'Action') // ou Science Fiction selon tes données
            ->select('acteurs.nom', 'acteurs.prenom')
            ->distinct() // Pour éviter les doublons si l'acteur a fait 2 films d'action
            ->get();

        // 3) Titre, Nom Acteur, Rôle
        $resultats['Ex7_Q3_Details_Complets'] = DB::table('participations')
            ->join('films', 'participations.films_id', '=', 'films.id')
            ->join('acteurs', 'participations.acteur_id', '=', 'acteurs.id')
            ->select('films.titre', 'acteurs.nom', 'participations.role')
            ->get();

        // 4) Acteurs sans film (Left Join + Where Null)
        $resultats['Ex7_Q4_Acteurs_Chomeurs'] = DB::table('acteurs')
            ->leftJoin('participations', 'acteurs.id', '=', 'participations.acteur_id')
            ->whereNull('participations.films_id')
            ->select('acteurs.*')
            ->get();

        // 5) Films avec plus de 3 participations (GroupBy + Having)
        $resultats['Ex7_Q5_Gros_Casting'] = DB::table('participations')
            ->join('films', 'participations.films_id', '=', 'films.id')
            ->select('films.titre', DB::raw('count(*) as total_acteurs'))
            ->groupBy('films.id', 'films.titre')
            ->having('total_acteurs', '>', 3)
            ->get();

        // 6) Acteurs dans films entre 2010 et 2020
        $resultats['Ex7_Q6_Acteurs_2010_2020'] = DB::table('acteurs')
            ->join('participations', 'acteurs.id', '=', 'participations.acteur_id')
            ->join('films', 'participations.films_id', '=', 'films.id')
            ->whereBetween('films.annee', [2010, 2020])
            ->select('acteurs.nom')
            ->distinct()
            ->get();

        // --- AFFICHAGE FINAL ---
        // Clique sur les petites flèches noires dans le navigateur pour voir les détails
        return dd($resultats);
    }
}
