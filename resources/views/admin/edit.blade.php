@extends('layouts.admin')

@section('content')
<div class="pt-3">
    <h2>Modifica ristorante {{ $restaurant->name }}</h2>

    <form action="{{ Route('admin.restaurants.update', $restaurant) }}" class="my-3" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <small class="d-block">Immagine</small>
        <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }} image" width="200" class="mb-2">
        <input type="file" name="image" class="@error('image') is-invalid @enderror d-block" id="image" placeholder="Carica un'immagine di massimo 150KB" value="{{ $restaurant->image }}">

        <small>Nome</small>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Inserisci il nome" value="{{ $restaurant->name }}" required>

        <small>Indirizzo</small>
        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Inserisci l'indirizzo" value="{{ $restaurant->address }}" required>
        
        <small>Partita IVA</small>
        <input id="piva" type="text" pattern="[0-9]+" class="form-control @error('piva') is-invalid @enderror" name="piva" placeholder="Inserisci la partita IVA" value="{{ $restaurant->piva }}" required autocomplete="piva" minlength="11" maxlength="11">

        <small class="d-block">Tipo/i di cucina</small>
        <div class="mb-3">
            <div class="row">
            @foreach ($types as $type)
                <div class="col-6 col-md-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="type-{{ $type->id }}" name="types[]" value="{{ $type->id }}" @if ($restaurant->types->contains($type)) checked="checked" @endif style="margin-bottom: 0px">
                        <label class="form-check-label" for="type-{{ $type->id }}">{{ $type->name }}</label>
                    </div>
                </div>
            @endforeach
            </div>
        </div>

        <a href="{{ Route('admin.restaurants.index') }}" class="btn border-info text-info">
            <i class="fas fa-arrow-left mr-1"></i>
            <span>
                Indietro
            </span>
        </a>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save mr-1"></i>
            Salva
        </button>
    </form>    
</div>
@endsection