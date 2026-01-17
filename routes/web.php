<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function(){
    return "Bonjour Laravel";
});
Route::get('accueil', function(){
    return view("accueil");
});
Route::get('test', [TestController::class,"index"]);
Route::get('test', [TestController::class,"show"]);
Route::view("/view",'accueil');
Route::view('/accueil', 'accueil')->name('accueil');
Route::view("/test2",'test');
Route::get('/home2/{nom}', function ($nom) {
    return 'Bonjour ' . $nom;

});
Route::get('/home3/{nom}/{age}', function ($nom, $age) {
    return "Bonjour $nom votre Age est $age ans";
});

Route::get('/home2/{nom}/{age?}', function ($nom, $age = null) {
    if ($age) {
        return "Bonjour $nom votre Age est $age ans";
    }
    return "Bonjour $nom";
});
