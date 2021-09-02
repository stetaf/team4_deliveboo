@extends('layouts.admin')

@section('content')
    <ul>
        @foreach ($restaurants as $restaurant)
            <li><a href="{{ Route('admin.restaurants.show', $restaurant->id) }}">{{ $restaurant->name }}</a></li>
        @endforeach
    </ul>
@endsection