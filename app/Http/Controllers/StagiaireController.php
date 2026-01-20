<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $stagiaires = Stagiaire::all();
    return view('stagiaires.index', compact('stagiaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stagiaires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     Stagiaire::create($request->all());
    return redirect()->route('stagiaires.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stagiaire $stagiaire)
    {
       return view('stagiaires.show', compact('stagiaire'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stagiaire $stagiaire)
    {
       return view('stagiaires.edit', ['stagiaire' => $stagiaire]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stagiaire $stagiaire)
    {
       $stagiaire->nom = $request->nom;
    $stagiaire->prenom = $request->prenom;
    $stagiaire->age = $request->age;
    $stagiaire->save();
    return redirect()->route('stagiaires.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stagiaire $stagiaire)
    {
          $stagiaire->delete();
    return redirect()->route('stagiaires.index');
     
    }
}
