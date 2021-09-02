@extends('layouts.admin')

@section('content')
    <!-- MODIFICA PIATTO RISTORANTE -->
    <h1>Modifica piatto</h1>

    <form action="{{ Route('admin.dish.update', $dish) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="restaurant_id" value="{{ $dish->restaurant_id }}">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the name" value="{{ $dish->name }}" required>
        <textarea name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" placeholder="Enter the ingredients" required>{{ $dish->ingredients }}</textarea>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter the description" required>{{ $dish->description }}</textarea>
        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the price" value="{{ $dish->price }}" required>
        <input type="number" name="visible" class="form-control @error('visible') is-invalid @enderror" id="visible" placeholder="Enter the visible" value="{{ $dish->visible }}" required>
        <input type="file" name="image" id="image" value="{{ $dish->image }}">

        <button type="submit" class="form-control btn btn-danger">Confirm</button>
    </form>
    <!-- /MODIFICA PIATTO RISTORANTE -->
    
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-success">Torna indietro</a>
@endsection