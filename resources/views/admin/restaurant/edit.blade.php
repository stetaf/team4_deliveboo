@extends('layouts.admin')

@section('content')
<!-- MODIFICA PIATTO RISTORANTE -->
<div class="pt-5">
    <h2>Modifica il piatto</h2>

    <form action="{{ Route('admin.dish.update', $dish->id) }}" class="my-5" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <img src="{{asset('storage/'. $dish->image)}}" class="mb-2" alt="{{ $dish->name }}" style="width:200px">
        <input type="file" name="image" class="@error('image') is-invalid @enderror d-block" id="image" placeholder="Carica un'immagine di massimo 150K" value="{{ $dish->image }}">
        
        <small>Nome</small>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the name" value="{{ $dish->name }}" required>
        
        <small>Ingredienti</small>
        <input type="text" name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" placeholder="Enter the ingredients" value="{{ $dish->ingredients }}" required>
        
        <small>Descrizione</small>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter the description" value="{{ $dish->description }}" required>
        
        <small>Prezzo</small>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the price" value="{{ $dish->price }}" step="0.01" pattern="[0-9]" min="0.00" required>
        
        <!-- radio button -->
        <input type="radio" id="visible" name="visible" value="1" {{ ($dish->visible == true) ? 'checked' : '' }}>
        <label for="visible"> Visibile</label><br>
        <input type="radio" id="visible" name="visible" value="0" {{ ($dish->visible == false) ? 'checked' : '' }}>
        <label for="visible"> Non visibile</label><br>
        <!-- //radio button -->

        <button type="submit" class="btn btn-success mb-2">Modifica</button>
        <a href="{{ url()->previous() }}">
            <span class="btn border-info mb-2 text-info">Indietro</span>
        </a>
    </form>
    
</div>
@endsection