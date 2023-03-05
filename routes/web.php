<?php

use App\Models\Commande;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HistoriqueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[BackController::class, 'index']);
Route::get('/historique',[HistoriqueController::class, 'index']);
Route::get('/product',[ProductController::class, 'getAllProduct']);
Route::get('/get-commande-details/{commandeId}', function($commandeId) {
    $commandeDetails = Commande::where('commande_meres_id', $commandeId)->get();
    return response()->json($commandeDetails);
});


Route::post('/insertProduit',[ProductController::class, 'store'])->name('insertProduit');

Route::delete('/produit/{id}', [ProductController::class,'delete'])->name('produit.delete');




