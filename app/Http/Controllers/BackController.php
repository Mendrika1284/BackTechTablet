<?php

namespace App\Http\Controllers;


use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class BackController extends Controller
{
    //Fonction de base
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;
    
        $response = Http::get('https://dev.techtablet.fr/apiv2/products');
        $productData = $response->json();
        $total = count($productData);
    
        $items = array_slice($productData, $offset, $perPage);
    
        $products = new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
    
        return view('dashboard', ['listeProduit' => $products]);
    }


    
    
    
    
    
    
    
    
    
    
    
    
    
}
