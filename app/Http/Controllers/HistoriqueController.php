<?php

namespace App\Http\Controllers;

use App\Models\CommandeMere;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function index(Request $request){
        $query = CommandeMere::query();
    
        // Search by nom
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('nom', 'like', '%'.$searchTerm.'%');
        }
    
        // Sort by price
        if ($request->has('sort')) {
            $sortOrder = $request->input('order') === 'asc' ? 'asc' : 'desc';
            if ($request->input('sort') == 'price') {
                $query->orderBy('grandTotal', $sortOrder);
            }
        }

    
        $listeCommande = $query->paginate(10);
    
        return view('historique',[
            'listeCommandeMere' => $listeCommande,
            'searchTerm' => $searchTerm ?? null,
            'sortOrder' => $sortOrder ?? null
        ]);
    }
    
}
