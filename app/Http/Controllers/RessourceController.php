<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return "je suis le contrôleur RessourceController";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return "je suis la méthode create du Contrôleur RessourceController";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "je suis la méthode show du Contrôleur RessourceController’. $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       return "je suis la méthode edit du Contrôleur RessourceController. $id";
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
