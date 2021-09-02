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

    <div v-for="type in types" @click="sortBy(type.id)">
        <span>@{{ type.name }}</span>
        <img :src="/img/ + type.image" width="45">
    </div>

    <h3>Risultati per: @{{ filter }}</h3>

    <ul>
        <li v-for="restaurant in laravelData.data">
            <span>@{{ restaurant.name }}</span>
        </li>
    </ul>

    <pagination :data="laravelData" @pagination-change-page="getResults" :show-disabled="true">
        <span slot="prev-nav">&lt; Previous</span>
        <span slot="next-nav">Next &gt;</span>
    </pagination>  
@endsection