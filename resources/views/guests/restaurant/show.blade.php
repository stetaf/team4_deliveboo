@extends('layouts.app')

@section('content')
<div class="restaurant_image">
    <img src="{{ asset('storage' . $restaurant->image) }}" alt="">
    <h1 class="display-4">{{ $restaurant->name }}</h1>
</div>

<div class="container">
    <h2 class="mt-3 mb-5">I nostri piatti</h2>
    <div class="row">
        @foreach ($dishes as $dish)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="dish_card product_item">
                <div class="body">
                    <div class="cp_img">
                        <img src="{{ asset('storage/' . $dish->image) }}" alt="Product" class="img-fluid w-100">
                        <div class="hover">
                            <a href="#" class="btn btn-secondary btn-sm waves-effect text-white w-25" data-toggle="modal" data-target="{{ '#modalPush' . $dish->id }}">
                                <i class="fas fa-info"></i>
                            </a>
                            <span class="btn btn-success btn-sm waves-effect text-white w-25" @click="addToCart({{ $restaurant->id }}, {{ $dish }})">
                                <i class="fas fa-shopping-cart px-2"></i>
                            </span>
                        </div>
                    </div>
                    <div class="product_details">
                        <h5>{{ $dish->name }}</h5>
                        <ul class="product_price list-unstyled">
                            <li class="old_price">€ {{ $dish->price }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product modal -->
        <div class="modal fade" id="{{ 'modalPush' . $dish->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                    <div class="d-flex flex-wrap">
                                        <img src="{{ asset('storage/' . $dish->image) }}" class="w-100 mb-2" alt="{{ $dish->name }} image">
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
                        <span class="btn btn-success btn-sm waves-effect text-white" @click="addToCart({{ $restaurant->id }}, {{ $dish }})">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            Aggiungi al carrello
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Product modal -->
        @endforeach
    </div>

    <div class="shopping_cart" data-toggle="modal" data-target="#cart">
        <i class="fas fa-shopping-cart"></i>
        <span class="items" v-if="cart[1].length > 0">
            @{{ cart[1].length }}
        </span>
        <span class="items" v-else>
            0
        </span>
    </div>

    <!-- Cart modal -->
    <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="cartTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="cartTitle">
                        <i class="fas fa-shopping-cart"></i>
                        Il tuo carrello
                    </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="cart_table table-responsive">
                        <h4 v-if="cart[1].length == 0">Non hai ancora aggiunto nessun piatto!</h4>
                        <table class="table tbl-cart" v-else>
                            <thead>
                                <tr>
                                    <td class="border-top-0">Immagine</td>
                                    <td class="border-top-0">Prodotto</td>
                                    <td class="border-top-0">Quantità</td>
                                    <td class="border-top-0">Prezzo</td>
                                    <td class="border-top-0"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in cart[1]">
                                    <td class="hidden-xs">
                                        <img :src="'/storage/'+ item.image" :alt="item.name" width="50" height="40">
                                    </td>
                                    <td>
                                        <span>@{{ item.name }}</span>
                                    </td>
                                    <td>
                                        <div class="qty">
                                            <span class="minus" @click="removeItem(item)">
                                                <i class="fas fa-minus"></i>
                                            </span>
                                            <input type="number" class="count border-0 text-center" name="quantity" :value="item.quantity" max="99">
                                            <span class="plus" @click="addToCart({{ $restaurant->id }}, item)">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="price">
                                        &euro; @{{ (item.price * item.quantity).toFixed(2) }}
                                    </td>
                                    <td class="text-center">
                                        <span style="font-size:20px" @click="clearItem(item)">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Totale: € @{{ cart_total.toFixed(2) }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        Chiudi
                    </button>
                    <a href="{{ Route('guests.restaurant.checkout', $restaurant->id) }}"  class="btn btn-success" :disabled="cart[1].length == 0">
                        <i class="far fa-credit-card mr-1 align-middle"></i>
                        Vai alla cassa
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Cart modal -->
</div>
@endsection
