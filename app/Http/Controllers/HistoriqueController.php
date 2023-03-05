<?php

namespace App\Http\Controllers;

use App\Models\CommandeMere;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function index(){
        $listeCommande = CommandeMere::paginate(10);
        return view('historique',[
            'listeCommandeMere' => $listeCommande
        ]);
    }
}
