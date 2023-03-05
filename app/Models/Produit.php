<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduit'
    ];

    public static function insertProduit($idProduit)
    {
        return static::create([
            'idProduit' => $idProduit
        ]);
    }

    // Fonction pour vérifier si le produit a déjà été inserer
    public static function checkIfAlreadyInserted($idProduit){
        $produit = static::where('idProduit', $idProduit)->first();
        if ($produit) {
            return true;
        }else{
            return false;
        }
    }

    //Fonction pour vérifier si le nombre de produit déjà afficher = 10
    public static function checkIfProductIsFull(){
        $productCount = Produit::count();
        if($productCount == 10){
            return true;
        }else{
            return false;
        }
    }

}
