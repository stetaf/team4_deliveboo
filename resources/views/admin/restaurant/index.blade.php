@extends('layouts.admin')

@section('content')
    <span>{{ $restaurant->name }}</span>
    
    <hr>
    <!-- DELETE -->
    <h1>Delete restaurant</h1>

    <form action="{{ Route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Confirm</button>
    </form>
    <!-- /DELETE -->

    <hr>
    <!-- NEW -->
    <H1>New restaurant</H1>

    <form action="{{ Route('admin.restaurants.store') }}" method="POST">
        @csrf

        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the name" value="{{ old('name') }}" required>
        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter the address" value="{{ old('address') }}" required>
        <input type="number" name="piva" class="form-control @error('piva') is-invalid @enderror" id="piva" placeholder="Enter the piva" value="{{ old('piva') }}" required>

        <button type="submit" class="btn btn-danger">Confirm</button>
    </form>
    <!-- /NEW -->

    <hr>
    <!-- PIATTI RISTORANTE -->
    <h1>Piatti</h1>

    <ul>
        @foreach ($dishes as $dish) 
            <li>
                {{ $dish->name }}
                <a href="{{ Route('admin.dish.edit', $dish->id) }}"><input class="btn btn-sm btn-primary ml-4" type="button" value="modifica"></a>
                <form action="{{ Route('admin.dish.delete', $dish->id) }}" class="d-inline-block" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-sm btn-danger" value="Elimina">
                </form>
            </li>
        @endforeach
    </ul>
    <!-- /PIATTI RISTORANTE -->

    <hr>
    <!-- NUOVO PIATTO RISTORANTE -->
    <h1>Nuovo piatto</h1>

    <form action="{{ Route('admin.dish.store', $restaurant->id) }}" method="POST">
        @csrf
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the name" value="{{ old('name') }}" required>
        <input type="text" name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" placeholder="Enter the ingredients" value="{{ old('ingredients') }}" required>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter the description" value="{{ old('description') }}" required>
        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the price" value="{{ old('price') }}" required>
        <input type="number" name="visible" class="form-control @error('visible') is-invalid @enderror" id="visible" placeholder="Enter the visible" value="{{ old('visible') }}" required>

        <button type="submit" class="btn btn-danger">Confirm</button>
    </form>
    <!-- /NUOVO PIATTO RISTORANTE -->
@endsection