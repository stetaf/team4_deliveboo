@extends('layouts.admin')

@section('content')
    <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">
        <div class="col-12">
            <div class="head d-flex justify-content-between align-items-center mt-3 w-100">
                <h2>I tuoi ristoranti</h2>
                <div class="btn btn-sm btn-success">
                    <a href="{{ Route('admin.restaurants.create') }}">
                        <i class="fas fa-plus mr-1" style="vertical-align:middle"></i>
                        Aggiungi ristorante
                    </a>
                </div>
            </div>
        </div>
        @foreach ($restaurants as $restaurant)
        <div class="col-sm">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{asset('storage/'. $restaurant->image)}}" alt="" class="admin_image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body d-flex justify-content-between align-items-center h-100">
                            <div class="data d-flex flex-column w-75">
                                <h5 class="card-title">{{ $restaurant->name }}</h5>
                                <span class="card-text">P.IVA: {{ $restaurant->piva }}</span>
                                <span class="card-text">Address: {{ $restaurant->address }}</span>
                                <div class="div">
                                    @foreach ($restaurant->types as $category)
                                        <span class="badge badge-primary mr-1" style="background-color: #d3273e; padding: 4px 6px !important; width:75px">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="actions d-flex flex-column justify-content-center align-items-end w-50">
    
                                <a href="{{ Route('admin.restaurants.show', $restaurant->id) }}" class="btn btn-sm btn-success w-50 text-white">
                                    <span>
                                        <i class="fas fa-cog mr-1" style="vertical-align:middle"></i>
                                        Gestione
                                    </span>
                                </a>
                                <a href="{{ Route('admin.overview', $restaurant->id) }}" class="btn btn-sm btn-primary w-50 text-white mt-1">
                                    <span>
                                        <i class="fas fa-paste" style="vertical-align:middle"></i> 
                                        Riepilogo
                                    </span>
                                </a>
                                <a href="{{ Route('admin.overview.graphs', $restaurant->id) }}" class="btn btn-sm btn-info w-50 text-white my-1">
                                    <span>
                                        <i class="fas fa-chart-line" style="vertical-align:middle"></i> 
                                        Statistiche
                                    </span>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#del{{ $restaurant->id }}" class="btn btn-sm btn-danger w-50 text-white">
                                    <span>
                                        <i class="fas fa-trash-alt mr-1" style="vertical-align:middle"></i>
                                        Elimina
                                    </span>
                                </a>
    
                                <div class="modal fade" id="del{{ $restaurant->id }}" tabindex="-1" role="dialog" aria-labelledby="modal_label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal_label">Warning</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Sei sicuro di voler eliminare il ristorante '{{ $restaurant->name }}' ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Annulla</button>
                                                <form action="{{ Route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection