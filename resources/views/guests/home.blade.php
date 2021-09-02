@extends('layouts.app')

@section('content')    
    <main>
        <div class="jumbotron jumbotron-fluid">
            <div class="container d-flex justify-content-center align-items-center h-100">
                <h1 class="display-4" >I tuoi piatti preferiti, quando vuoi.</h1>
            </div>
        </div>
        <div class="sep p-4">
            <div class="container">
                <div class="row row-cols-sm-2 row-cols-md-4 row-cols-lg-6">
                        <div v-for="type in types" @click="sortBy(type.id)" class="my-3 col d-flex align-items-center flex-column">
                            <div class="type">
                                <img :src="/img/ + type.image" width="45" @click="filterBy(type.id)">
                                <small>@{{ type.name }}</small>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="categories">
            <div class="container">
                <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-6">
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
        <div class="restaurants">
            <div class="container">

            </div>
        </div>
    </main>
@endsection