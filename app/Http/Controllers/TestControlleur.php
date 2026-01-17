<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestControlleur extends Controller
{
   public function index (){
return 'je suis le contrôleur TestController';
    }
    public function show (){
return view("accueil");
    }
}
