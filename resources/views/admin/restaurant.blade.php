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
    </body>
</html>
