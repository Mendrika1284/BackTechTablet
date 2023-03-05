<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeMere;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommandeAPIController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $latestCommandeMere = CommandeMere::where('estValide', 0)->latest()->first();
        
        if ($latestCommandeMere) {
            $commandeMere = $latestCommandeMere;
        } else {
            $commandeMere = new CommandeMere();
            $commandeMere->estValide = 0;
            $commandeMere->save();
        }
    
        $commande = new Commande();
        $commande->idProduit = $request->input('idProduit');
        $commande->nomProduit = $request->input('nomProduit');
        $commande->image = $request->input('image');
        $commande->quantite = $request->input('quantite');
        $commande->prixUnitaire = $request->input('prixUnitaire');
        $commande->prixTotal = $request->input('prixTotal');
        $commande->commande_meres_id = $commandeMere->id;
        $commande->save();
    
        return response()->json(['status' => 201], 201);
    }

    // Fonction pour les informations de l'utilisateur pour valider la commande
    public function valider(Request $request, $id)
    {
        $commandeMere = CommandeMere::find($id);
        
        if (!$commandeMere) {
            return response()->json(['error' => 'CommandeMere not found'], 404);
        }
        
        $commandeMere->email = $request->input('email');
        $commandeMere->nom = $request->input('nom');
        $commandeMere->prenom = $request->input('prenom');
        $commandeMere->adresseLivraison = $request->input('adresseLivraison');
        $commandeMere->grandTotal = $request->input('grandTotal');
        $commandeMere->quantiteTotal = $request->input('quantiteTotal');
        $commandeMere->estValide = 1;
        $commandeMere->save();
        
        return response()->json(['status' => 'Commande valider avec succès'], 200);
    }

    

    // Fonction pour compter le nombre de commande
    public function countCommands()
    {
        $latestCommandeMereId = CommandeMere::where('estValide', 0)->max('id');
        $count = Commande::where('commande_meres_id', $latestCommandeMereId)->count();
    
        return response()->json(['count' => $count]);
    }
    

}
