@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container d-flex justify-content-center align-items-center h-100">
            <h1 class="display-4" >I tuoi piatti preferiti, quando vuoi.</h1>
        </div>
    </div>
    <div class="sep p-4">
        <div class="container">
            <div class="text-center">
                <p class="display-4 text-white">Cosa vuoi mangiare?</p>
            </div>
            <div class="row row-cols-xs-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6">
                <div v-for="type in types" @click="filterBy(type.id)" class="my-3 col d-flex align-items-center flex-column ih-item circle colored effect1">
                    <span class="m-auto" href="#">
                        <div class="spinner"></div>
                        <div class="img">
                            <img :src="/img/ + type.image" alt="img">
                        </div>
                        <div class="info">
                            <div class="info-back">
                                <h3>@{{ type.name }}</h3>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="results">
        <div class="container">
            <div class="text-center py-2" v-if="filtered_results.data && filtered_results.data.length > 0">
                <h2 class="res">Risultati inerenti alla tua ricerca:</h2>
            </div>
            <div class="text-center py-2 fs-35" :class=" (no_results) ? '' : 'd-none'">
                <i class="far fa-frown"></i>
                <h2 class="res">Nessun risultato inerente alla tua ricerca</h2>
            </div>
            <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-4">
                <div class="col" v-for="restaurant in filtered_results.data" :key="restaurant.id">
                    <div class="card text-right" style="min-height:255px; position:relative">
                        <div class="image img-fluid position-relative">
                            <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="" class="w-100">
                            <div class="badges text-right position-absolute" style="right:0px; bottom:0px">
                                <span class="badge badge-primary m-1" style="background-color: #d3273e; color: #dedede; padding: 4px 6px !important" v-for="type in restaurant.types">@{{ type.name }}</span>
                            </div>
                        </div>    
                        <div class="px-1 pt-2" style="min-height: 55px">
                            <h5 class="font-weight-bold text-center">@{{ restaurant.name }}</h5>
                        </div>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <a :href="/restaurant/ + restaurant.id">
                                <span class="btn btn-sm text-light" style="background-color: #d3273e">
                                    Ordina
                                </span>
                            </a>
                            <small class="font-italic">@{{ restaurant.address }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <pagination :data="filtered_results" @pagination-change-page="getResults" :show-disabled="true" align="center">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </div>
    </div>
    <div class="categories">
        <div class="container">
            <div class="text-center">
                <p class="display-4 text-white text-dark">Ristoranti popolari</p>
            </div>
            <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-4">
                <div class="col">
                    <div class="card text-right">
                        <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="">
                        <h4>Da Giovanni</h4>
                        <div class="p-1">
                            <span class="badge badge-primary p-2" style="background-color: #d3273e; color: #dedede; padding: 4px 6px !important">Mediterranea</span>
                            <span class="badge badge-secondary p-2" style="background-color: #d3273e; color: #dedede; padding: 4px 6px !important">Pizza</span>
                            <span class="badge badge-success p-2" style="background-color: #d3273e; color: #dedede; padding: 4px 6px !important">Carne</span>
                        </div>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <span class="btn btn-sm text-light" style="background-color: #d3273e">Ordina</span>
                            <small>Via Giuseppe Verdi, 12</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-right">
                        <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="">
                        <h4>Da Giovanni</h4>
                        <span>Mediterranea, pizza</span>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <span class="btn btn-sm text-light" style="background-color: #008080">Ordina</span>
                            <small>Via Giuseppe Verdi, 12</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-right">
                        <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="">
                        <h4>Da Giovanni</h4>
                        <span>Mediterranea, pizza</span>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <span class="btn btn-sm text-light" style="background-color: #008080">Ordina</span>
                            <small>Via Giuseppe Verdi, 12</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-right">
                        <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="">
                        <h4>Da Giovanni</h4>
                        <span>Mediterranea, pizza</span>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <span class="btn btn-sm text-light" style="background-color: #008080">Ordina</span>
                            <small>Via Giuseppe Verdi, 12</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-right">
                        <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="">
                        <h4>Da Giovanni</h4>
                        <span>Mediterranea, pizza</span>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <span class="btn btn-sm text-light" style="background-color: #008080">Ordina</span>
                            <small>Via Giuseppe Verdi, 12</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-right">
                        <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="">
                        <h4>Da Giovanni</h4>
                        <span>Mediterranea, pizza</span>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <span class="btn btn-sm text-light" style="background-color: #008080">Ordina</span>
                            <small>Via Giuseppe Verdi, 12</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-right">
                        <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="">
                        <h4>Da Giovanni</h4>
                        <span>Mediterranea, pizza</span>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <span class="btn btn-sm text-light" style="background-color: #008080">Ordina</span>
                            <small>Via Giuseppe Verdi, 12</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-right">
                        <img src="https://foodies-api.initstore.net/uploads/2.jpg" alt="">
                        <h4>Da Giovanni</h4>
                        <span>Mediterranea, pizza</span>
                        <div class="cuisine">
                            <i class="fas fa-bookmark" style="font-size: 60px;color: #0c6f80;transform: rotate(270deg);"></i>
                            <i class="fas fa-pizza-slice" style="position: absolute;left: 20%;top: 31%; color: white; font-size: 23px;"></i>
                        </div>
                        <div style="background-color: #dedede" class="p-2 d-flex justify-content-between align-items-center">
                            <span class="btn btn-sm text-light" style="background-color: #008080">Ordina</span>
                            <small>Via Giuseppe Verdi, 12</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container">

        <div class="how">
            <div class="row text-center">
                <div class="col">
                    <h2>Come funziona?</h2>
                    <p>E' facile! Devi solo scegliere cosa mangiare</p>
                </div>
            </div>
            <div class="row text-center">
                <div class=" step col">
                    <i class="fas fa-store-alt fa-2x"></i>
                    <span class='number'>1</span>
                    <h4>Scegli un ristorante</h4>
                    <small>Scegli, tra la nostra selezione di ristoranti, quello che più ti piace</small>
                </div>
                <div class="step col">
                    <i class="fas fa-credit-card fa-2x"></i>
                    <span class='number'>2</span>
                    <h4>Paga con carta di credito</h4>
                    <small>Facile, veloce e 100% sicuro!</small>
                </div>
                <div class="step col">
                    <i class="fas fa-truck fa-2x"></i>
                    <span class='number'>3</span>
                    <h4>Aspetta la consegna</h4>
                    <small>Entro 30 minuti, direttamente a casa tua</small>
                </div>
            </div>
        </div>
    </div>
@endsection