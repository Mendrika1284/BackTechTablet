@extends('layouts.app')
@section('content')
    <div class="content">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('errorFull'))
            <div class="alert alert-danger">
                {{ session('errorFull') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach($listeProduit as $produit)
                <div class="col-md-6">
                    <form action="{{route('insertProduit')}}" method="POST">
                        @csrf
                        <div class="card ">
                            <div class="card-header ">
                                <input type="hidden" value="{{$produit}}" name="idProduit">
                                <h5 class="card-title">{{ $produit}} <center><button type="submit" class="btn btn-outline-primary">Selectionner</button></center></h5>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
        {{ $listeProduit->links('pagination::bootstrap-4') }}
    </div>
@endsection
