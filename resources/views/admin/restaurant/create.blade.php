@extends('layouts.admin')

@section('content')

<!-- NUOVO PIATTO RISTORANTE -->
<div class="pt-5">
    <h2>Nuovo piatto</h2>

    <form action="{{ Route('admin.dish.store', $restaurant->id) }}" class="my-5" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="image" class="@error('image') is-invalid @enderror" id="image" placeholder="Carica un'immagine di massimo 150K" value="{{ old('image') }}">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the name" value="{{ old('name') }}" required>
        <input type="text" name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" placeholder="Enter the ingredients" value="{{ old('ingredients') }}" required>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter the description" value="{{ old('description') }}" required>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the price" value="{{ old('price') }}" step="0.01" pattern="[0-9]" min="0.00" required>
        <input type="radio" id="visible" name="visible" value="1">
        <label for="visible"> Visibile</label><br>
        <input type="radio" id="visible" name="visible" value="0">
        <label for="visible"> Non visibile</label><br>
        <button type="submit" class="btn btn-success mb-2">Crea</button>
        <span class="btn border-info mb-2">
            <a href="{{ url()->previous() }}" class="text-info">Indietro</a>
        </span>
    </form>
    
</div>
<!-- /NUOVO PIATTO RISTORANTE -->

@endsection