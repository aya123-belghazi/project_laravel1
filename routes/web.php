<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\InvokeContoller;
use App\Http\Controllers\RessourceController;
use Illuminate\Support\Facades\Route;

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
Route::get("/one",[BaseController::class,'OneMethode']);
Route::get("/index",[BaseController::class,'Index']);
Route::get("/afficher/{nom}/{age}",[BaseController::class,'afficher']);
Route::get("/oneAction",InvokeContoller::class);
Route::resource('/MaRessource',RessourceController::class);
