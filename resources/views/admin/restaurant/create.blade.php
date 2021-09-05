@extends('layouts.admin')

@section('content')

<!-- NUOVO PIATTO RISTORANTE -->
<div class="pb-5 mt-3">
    <h2>Nuovo piatto</h2>

    <form action="{{ Route('admin.dish.store', $restaurant->id) }}" class="my-5" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="image" class="@error('image') is-invalid @enderror" id="image" placeholder="Carica un'immagine di massimo 150K" value="{{ old('image') }}">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Inserisci il nome" value="{{ old('name') }}" required>
        <textarea rows="5" name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" placeholder="Inserisci gli ingredienti" required>{{ old('ingredients') }} </textarea>
        <textarea rows='5' name="description" class="mt-3 mb-3 form-control @error('description') is-invalid @enderror" id="description" placeholder="Inserisci la descrizione" required>{{ old('description') }}</textarea>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Inserisci il prezzo in €" value="{{ old('price') }}" step="0.01" pattern="[0-9]" min="0.00" required>
        <input type="radio" id="visible" name="visible" value="1">
        <label for="visible"> Visibile</label><br>
        <input type="radio" id="visible" name="visible" value="0">
        <label for="visible"> Non visibile</label><br>
        <button type="submit" class="btn btn-success mb-2">Crea</button>
        <a href="{{ url()->previous() }}">
            <span class="btn border-info mb-2 text-info">Indietro</span>
        </a>
        
    </form>
    
</div>
<!-- /NUOVO PIATTO RISTORANTE -->

@endsection