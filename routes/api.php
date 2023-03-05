<?php

use App\Models\Commande;
use App\Models\CommandeMere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductAPIController;
use App\Http\Controllers\CommandeAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('product', ProductAPIController::class);
Route::post('/commande', [CommandeAPIController::class, 'store']);
Route::get('/commande/count', [CommandeAPIController::class, 'countCommands']);
Route::get('/listeCommande', function () {
    $latestCommandeMereId = CommandeMere::where('estValide', 0)->max('id');
    $commands = Commande::where('commande_meres_id', $latestCommandeMereId)->paginate(10);
    return response()->json(['commands' => $commands]);
});
Route::post('/commande/valider/{id}', [CommandeAPIController::class, 'valider']);