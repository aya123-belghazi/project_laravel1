<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvokeContoller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
       return "je suis le contrôleur a une seul action";
    }
}
