<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

        <span>{{ $restaurant->name }}</span>

        <form action="{{ Route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Confirm</button>
        </form>

        <form action="{{ Route('admin.restaurants.store') }}" method="POST">
            @csrf

            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the name" value="{{ old('name') }}" required>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter the address" value="{{ old('address') }}" required>
            <input type="number" name="piva" class="form-control @error('piva') is-invalid @enderror" id="piva" placeholder="Enter the piva" value="{{ old('piva') }}" required>

            <button type="submit" class="btn btn-danger">Confirm</button>
        </form>

        <h2>Piatti</h2>
        <ul>
            @foreach ($dishes as $dish) 
                <li>{{ $dish->name }}</li>
            @endforeach
        </ul>

        <form action="{{ Route('admin.dish.store', $restaurant->id) }}" method="POST">
            @csrf
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the name" value="{{ old('name') }}" required>
            <input type="text" name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" placeholder="Enter the ingredients" value="{{ old('ingredients') }}" required>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter the description" value="{{ old('description') }}" required>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the price" value="{{ old('price') }}" required>
            <input type="number" name="visible" class="form-control @error('visible') is-invalid @enderror" id="visible" placeholder="Enter the visible" value="{{ old('visible') }}" required>

            <button type="submit" class="btn btn-danger">Confirm</button>
        </form>
    </body>
</html>
