@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <a href="#" id="1"><span @click="sortBy(1)">Italiano</span></a>
    <a href="#" id="8"><span @click="sortBy(8)">Vegano</span></a>
    <a href="#" id="9"><span @click="sortBy(9)">Fast Food</span></a>

    <div class="results">

    </div>
@endsection