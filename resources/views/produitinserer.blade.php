@extends('layouts.app')

@section('content')
    <div class="content">
        <center><h1>Liste des produits afficher aux clients</h1></center>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach($listeProduit as $produit)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $produit['idProduit']}}</h5>
                            <form action="{{ route('produit.delete', $produit->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <center><button type="submit" class="btn btn-outline-danger">Supprimer</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $listeProduit->links('pagination::bootstrap-4') }}
    </div>
@endsection

