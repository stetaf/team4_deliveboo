@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-7 py-5">
                <h2>Inserisci i tuoi dati</h2>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <label for="customer_name">Nome completo</label>
                            <input type="text" class="form-control" name="customer_name" placeholder="Nome completo">
                        </div>
                        <div class="form-group col-md-6 mb-0">
                            <label for="customer_email">Email</label>
                            <input type="email" class="form-control" name="customer_email" placeholder="Email">
                        </div>
                        <div class="form-group col-12 mb-0">
                            <label for="customer_address">Indirizzo</label>
                            <input type="text" class="form-control" name="customer_address" placeholder="Indirizzo">
                        </div>
                        <div class="form-group col-12 mb-0">
                            <label for="customer_phone">Telefono</label>
                            <input type="text" class="form-control" name="customer_phone" placeholder="Telefono">
                        </div>
                        <div class="form-group col-12 mb-0">
                            <label for="notes">Note</label>
                            <textarea type="text" class="form-control" name="notes" rows="4"></textarea>
                        </div>
                        <div class="form-group col-12 mt-3 mb-0">
                            <button type="submit" class="btn btn-primary">Paga</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-5 py-5">
                <h2>Il tuo ordine</h2>
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
                                    <img :src="item.image" :alt="item.name" width="50" height="50">
                                </td>
                                <td>
                                    <span>@{{ item.name }}</span>
                                </td>
                                <td>
                                    <div class="qty">
                                        <span class="minus" @click="removeItem(item)">
                                            <i class="fas fa-minus"></i>
                                        </span>
                                        <input type="number" class="count border-0 text-center" name="qty" :value="item.qty" max="99">
                                        <span class="plus" @click="addToCart({{$restaurant->id}}, item)">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </div>
                                </td>
                                <td class="price">
                                    &euro; @{{ (item.price * item.qty).toFixed(2) }}
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
        </div>
    </div>
@endsection