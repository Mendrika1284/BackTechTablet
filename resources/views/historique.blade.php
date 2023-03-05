@extends('layouts.app')
@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('commandes.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Rechercher par nom">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="nc-icon nc-zoom-split"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th class="text-center" scope="col">Nom</th>
                    <th class="text-center" scope="col">Prénom</th>
                    <th class="text-center" scope="col">Nombre produit acheter</th>
                    <th class="text-center" scope="col">
                        <a href="{{ route('commandes.index', ['sort' => 'price', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                            Total
                            @if(request('sort') == 'price')
                                @if(request('order') == 'asc')
                                    <i class="fa fa-sort-asc"></i>
                                @else
                                    <i class="fa fa-sort-desc"></i>
                                @endif
                            @else
                                <i class="fa fa-sort"></i>
                            @endif
                        </a>
                    </th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($listeCommandeMere as $item)
                    <tr>
                        <th scope="row">{{$item['id']}}</th>
                        <td class="text-center">{{$item['nom']}}</td>
                        <td class="text-center">{{$item['prenom']}}</td>
                        <td class="text-center">{{$item['quantiteTotal']}}</td>
                        <td class="text-center">{{$item['grandTotal']}} €</td>
                        <td class="text-center"><a href="#" class="btn btn-outline-primary voir-btn" data-commande-id="{{$item['id']}}" data-toggle="modal" data-target="#myModal">Voir</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Commande détails</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table id="detailsTable" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produit</th>
                                    <th>Image</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Prix total</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Listen to the click event of the "Voir" button
        $('.voir-btn').click(function() {
            // Get the commande id from the data-commande-id attribute
            var commandeId = $(this).data('commande-id');

            // Make an AJAX request to fetch the data for the modal
            $.ajax({
                url: '/get-commande-details/' + commandeId,
                type: 'GET',
                success: function(data) {
                    // Clear the table body
                    $('#detailsTable tbody').empty();

                    // Fill the table body with the fetched data
                    $.each(data, function(i, item) {
                        $('#detailsTable tbody').append('<tr><td>' + item.idProduit + '</td><td>' + item.nomProduit + '</td><td><img src="' + item.image + '"></td><td>' + item.quantite + '</td><td>' + item.prixUnitaire + ' €</td><td>' + item.prixTotal + ' €</td></tr>');
                    });
                }
            });
        });
    });
</script>

@endsection