@extends('layouts.app')

@section('content')
<div class="restaurant_image">
    <img src="{{ asset('storage' . $restaurant->image) }}" alt="">
    <h1 class="display-4">{{ $restaurant->name }}</h1>
</div>

<div class="container">
    <h2 class="mt-2">I nostri piatti</h2>
    <div class="row">
        @foreach ($dishes as $dish)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="dish_card product_item">
                <div class="body">
                    <div class="cp_img">
                        <img src="{{ $dish->image }}" alt="Product" class="img-fluid w-100">
                        <div class="hover">
                            <a href="#" class="btn btn-secondary btn-sm waves-effect text-white w-25" data-toggle="modal" data-target="#modalPush">
                                <i class="fas fa-info"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-success btn-sm waves-effect text-white w-25">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product_details">
                        <h5><a href="ec-product-detail.html">{{ $dish->name }}</a></h5>
                        <ul class="product_price list-unstyled">
                            <li class="old_price">€ {{ $dish->price }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product modal -->
        <div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered modal-notify modal-info" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header d-flex justify-content-between">
                        <h3 class="heading">{{ $dish->name }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex">
                                    <div class="d-flex justify-content-center flex-wrap">
                                        <img src="{{ $dish->image }}" class="w-100 mb-2" alt="{{ $dish->name }} image">
                                        <div class="text-left">
                                            <h4 class="font-weight-bold text-left">Ingredienti:</h4>
                                            <p>{{ $dish->ingredients }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-left">
                                    <h4 class="font-weight-bold">Descrizione:</h4>
                                    <p>{{ $dish->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <span class="lead">&euro; {{ $dish->price }}</span>
                        <a href="javascript:void(0);" class="btn btn-success btn-sm waves-effect text-white">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            Aggiungi al carrello
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Product modal -->
        @endforeach
    </div>
</div>
@endsection