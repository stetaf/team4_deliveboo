@extends('layouts.admin')

@section('content')
<div class="py-5 px-0">
    <h1>{{ $restaurant->name }}</h1>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Menu</h2>
        <a href="{{ route('admin.dish.create', $restaurant) }}">
            <span class="btn btn-sm btn-info text-light">
                <i class="fas fa-plus mr-1" style="vertical-align:middle"></i>
                Aggiungi un piatto
            </span>
        </a>
    </div>   
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>IMMAGINE</th>
                <th>NOME</th>
                <th class="w-50">DESCRIZIONE</th>
                <th>INGREDIENTI</th>
                <th>PREZZO</th>
                <th>VISIBILE</th>
                <th class="pr-5">AZIONI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dishes as $dish)
            <tr>
                <td class="align-middle"> <img width="100" src="{{asset('storage/'. $dish->image)}}" alt="{{$dish->name}}"> </td>
                <td class="align-middle"> {{$dish->name}} </td>
                <td class="align-middle"> {{substr($dish->description, 0, 70)}}... </td>
                <td class="align-middle"> {{substr($dish->ingredients, 0, 29)}}... </td>
                <td class="text-center align-middle">&euro;{{$dish->price}} </td>
                <td class="text-center align-middle"> @if ($dish->visible)
                        <i class="fas fa-circle text-success"></i>
                    @else
                        <i class="fas fa-circle text-danger"></i>
                    @endif
                </td>
                <td class="d-flex flex-column align-middle">
                    <a href="{{ Route('admin.dish.show', $dish->id) }}">
                        <span class="btn btn-sm btn-success w-100">    
                            
                            <i class="fas fa-eye fa-sm fa-fw"></i> View 
                        </span>
                    </a>
                    <a href="{{ Route('admin.dish.edit', $dish->id) }}">
                        <span class="btn btn-sm btn-warning my-1 w-100">
                            <i class="fas fa-pencil-alt fa-sm fa-fw"></i> Edit 
                        </span>
                    </a>                    
                    <form action="{{ Route('admin.dish.delete', $dish->id) }}" class="d-inline-block" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" value="Elimina" class="btn btn-sm btn-danger" style="min-width: 100%;">
                            <i class="fas fa-trash fa-sm fa-fw"></i> 
                            Elimina
                        </button>
                    </form>                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ Route('admin.restaurants.index') }}">
        <span class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>
            Torna alla dashboard
        </span>
    </a>
</div>    
@endsection