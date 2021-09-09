@extends('layouts.admin')

@section('content')
<div class="row pt-5">
    <div class="col-12 col-md-6">
        <h1>Piatto: {{ $dish->name }}</h1>
        <div class="img">
            <img src="{{asset('storage/' . $dish->image)}}" alt="{{$dish->name}}" class="w-100">
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="desc mt-2">
            <h2>Descrizione</h2>
            <p>{{$dish->description}}</p>
        </div>
        <div class="ingredients">
            <h2>Ingredienti</h2>
            <p>{{$dish->ingredients}}</p>
        </div>
        <div class="price">
            <h2>Prezzo</h2>
            <p>{{$dish->price}}€</p>
        </div>
    </div>
    <div class="col-12 py-4">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary text-white">
            <i class="fas fa-arrow-left mr-1"></i>
            <span>Indietro</span>
        </a>
    </div>
</div>
</div>
@endsection