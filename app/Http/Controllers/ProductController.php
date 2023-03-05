<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //Fonction pour l'insertion de produit à afficher dans le frontOffice
    public function store(Request $request)
    {
        $idProduit = $request->input('idProduit');
        $idProduitExists = Produit::checkIfAlreadyInserted($idProduit);
        $isProduitsIsFull = Produit::checkIfProductIsFull();
        if ($idProduitExists == true) {
            return redirect()->back()->with('error', 'Ce produit a déjà été selectionner.');
        } else if($isProduitsIsFull == true) {
            return redirect()->back()->with('errorFull', 'Vous ne pouvez plus ajouter de produit.');
        } else {
            $product = Produit::insertProduit($idProduit);
            return redirect()->back()->with('success', 'Ce produit à été bien ajouté.');
        }
    }

    //Fonction pour voir la liste des produits insérer
    public function getAllProduct(){
        $product = Produit::paginate(10);
        return view('produitinserer',[
            'listeProduit' => $product
        ]);
    }

    //Fonction pour supprimer le produit choisi
    public function delete($id)
    {
        Produit::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Produit supprimé avec succès.');
    }

}
