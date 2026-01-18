<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
  public function Index(){
    return "je suis le controller de base";
  }
//   public function OneMethode(){
//     return "je suis une methode du controller de base";
//   }
 public function OneMethode(){
    return view("accueil");
  }
  public function afficher($nom,$age){
return view('afficher',['nom'=>$nom,'age'=>$age]);
  }
}
