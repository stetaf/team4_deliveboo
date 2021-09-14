@extends('layouts.app')

@section('content')
    <div class="container">
    @include ('layouts.partials.message')
    @include ('layouts.partials.errors')
        <div class="row">
        <div class="col-12 col-lg-6 py-5">
                <h2>Il tuo ordine</h2>
                <div class="cart_table table-responsive">
                    <h4 v-if="cart[1].length == 0">Non hai ancora aggiunto nessun piatto!</h4>
                    <table class="table tbl-cart" v-else>
                        <thead>
                            <tr>
                                <td class="border-top-0 d-none d-md-block">Immagine</td>
                                <td class="border-top-0">Prodotto</td>
                                <td class="border-top-0" style="min-width: 85px;">Quantità</td>
                                <td class="border-top-0" style="min-width: 92px;">Prezzo</td>
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
                                            <i class="fas fa-minus"></i>
                                        </span>
                                        <input type="number" class="count border-0 text-center" name="quantity" :value="item.quantity" max="99">
                                        <span class="plus" @click="addToCart({{$restaurant->id}}, item, 0)">
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
                        </tbody>
                    </table>
                    <span class="text-right d-block font-weight-bold" v-if="cart[1].length > 0">Totale: € @{{ cart_total.toFixed(2) }}</span>
                </div>
            </div>
            <div class="col-12 col-lg-6 py-5">
                <h2>Inserisci i tuoi dati</h2>
                <form method="POST" action="{{ Route('guests.restaurant.pay', $restaurant->id) }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <label for="customer_name">Nome completo</label>
                            <input type="text" class="form-control" name="customer_name" placeholder="Nome completo" value="{{ old('customer_name') }}" required>
                        </div>
                        <div class="form-group col-md-6 mb-0">
                            <label for="customer_email">Email</label>
                            <input type="email" class="form-control" name="customer_email" placeholder="Email" value="{{ old('customer_email') }}" required>
                        </div>
                        <div class="form-group col-12 mb-0">
                            <label for="customer_address">Indirizzo</label>
                            <input type="text" class="form-control" name="customer_address" placeholder="Indirizzo" value="{{ old('customer_address') }}" required>
                        </div>
                        <div class="form-group col-12 mb-0">
                            <label for="customer_phone">Telefono</label>
                            <input type="text" class="form-control" name="customer_phone" class="customer_phone" placeholder="Telefono" value="{{ old('customer_phone') }}" pattern="[0-9]+" required>
                        </div>
                        <div class="form-group col-12 mb-0">
                            <label for="notes">Note</label>
                            <textarea type="text" class="form-control" name="notes" rows="4">{{ old('notes') }}</textarea>
                        </div>
                        <input type="hidden" name="total" :value="cart_total">
                        <div class="form-group col-12 mt-3 mb-0">
                            <a href="{{ Route('guests.restaurant.show', $restaurant) }}" class="btn btn-secondary text-white">
                                <i class="fas fa-arrow-left mr-1"></i>
                                <span>Torna indietro</span>
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-shopping-cart mr-1"></i>
                                Prosegui col pagamento
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection