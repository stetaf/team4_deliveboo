@extends('layouts.app')

@section('content')
<div class="restaurant_image">
    <img src="{{ asset('storage/' . $restaurant->image) }}" alt="">
    <h1 class="display-4">{{ $restaurant->name }}</h1>
</div>

<div class="container">
    <h2 class="my-3 fs-35 font-weight-bold">I nostri piatti</h2>
    <div class="row">
        @foreach ($dishes as $dish)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card dish_card p-2 border">
                <div class="cp_img position-relative">
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="Product" class="img-fluid w-100">
                    <a href="#" class="btn btn-secondary btn-sm waves-effect text-white product_info" data-toggle="modal" data-target="{{ '#modalPush' . $dish->id }}">
                        <i class="fas fa-info"></i>
                    </a>
                </div>
                <div class="product_details mt-2 d-flex flex-column align-items-center">
                    <h5 class="text-center">{{ $dish->name }}</h5>
                    <span>&euro; {{ $dish->price }}</span>
                </div>
                <div class="product_actions d-flex justify-content-between">
                    <div class="qty d-flex align-items-end">
                        <div class="minus" @click="lowerQty({{ $dish->id }})">
                            <i class="fas fa-minus-circle"></i>
                        </div>
                        <div class="num mx-1">
                            <input class="text-center" type="number" name="qty" id="qty{{ $dish->id }}" pattern="[0-9]+" min="0" max="99" value="0"  disabled>
                        </div>
                        <div class="plus" @click="addQty({{ $dish->id }})">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>
                    <div class="add">
                        <span class="btn btn-success btn-sm waves-effect text-white" @click="addToCart({{ $restaurant->id }}, {{ $dish }}, 1)">
                            <i class="fas fa-shopping-cart px-2"></i>
                        </span>
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
                    <div class="modal-footer d-flex justify-content-start">
                        <span class="lead">&euro; {{ $dish->price }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Product modal -->
        @endforeach
    </div>

    <!-- Cart Icon -->
    <div class="cart_container">
        <div class="shopping_cart" data-toggle="modal" data-target="#cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="items" v-if="cart[1].length > 0">
                @{{ cart[2] }}
            </span>
            <span class="items" v-else>
                0
            </span>
        </div>
        
        <!-- Cart alert -->
        <div class="cart_alert alert alert-success d-none">
            <i class="fas fa-thumbs-up"></i>
            <span class="">Prodotto aggiunto</span>
        </div>
        <!-- /Cart alert -->
    </div>
    <!-- /Cart Icon -->

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
                                    <td class="border-top-0 d-none d-md-block">Immagine</td>
                                    <td class="border-top-0" style="width:140px">Prodotto</td>
                                    <td class="border-top-0">Quantità</td>
                                    <td class="border-top-0" style="min-width: 92px !important;">Prezzo</td>
                                    <td class="border-top-0"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in cart[1]">
                                    <td class="d-none d-md-block">
                                        <img :src="'/storage/'+ item.image" :alt="item.name" width="50" height="40">
                                    </td>
                                    <td>
                                        <span>@{{ item.name }}</span>
                                    </td>
                                    <td>
                                        <div class="qty">
                                            <span class="minus" @click="removeItem(item)">
                                                <i class="fas fa-xs fa-minus"></i>
                                            </span>
                                            <input type="number" class="count border-0 text-center" name="quantity" :value="item.quantity" max="99"  disabled>
                                            <span class="plus" @click="addToCart({{ $restaurant->id }}, item, 0)">
                                                <i class="fas fa-xs fa-plus"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="price">
                                        &euro; @{{ (item.price * item.quantity).toFixed(2) }}
                                    </td>
                                    <td class="text-center">
                                        <span class="cart_icon" @click="clearItem(item)">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span class="text-right d-block font-weight-bold" v-if="cart[1].length > 0">Totale: € @{{ cart_total.toFixed(2) }}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        Chiudi
                    </button>
                    <a href="{{ Route('guests.restaurant.checkout', $restaurant->id) }}" class="btn btn-success text-white" :disabled="cart[1].length == 0">
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
