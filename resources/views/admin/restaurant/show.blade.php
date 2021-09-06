@extends('layouts.admin')

@section('content')
<div class="pt-5">
    <h1>Piatto: {{ $dish->name }}</h1>
    <div class="img">
        <img src="{{$dish->image}}" alt="{{$dish->name}}">
    </div>
    <div class="desc">
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
    <a href="{{ url()->previous() }}">
            <span class="btn border-info mb-2 text-info">Indietro</span>
        </a>
</div>
@endsection