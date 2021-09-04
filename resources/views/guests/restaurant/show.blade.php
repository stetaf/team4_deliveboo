@extends('layouts.app')

@section('content')
<div class="restaurant_image">
    <img src="{{ asset('storage' . $restaurant->image) }}" alt="">
    <h1 class="display-4">{{ $restaurant->name }}</h1>
</div>

<div class="container">
    <h2 class="mt-2">I nostri piatti</h2>
    <div class="row">
        @foreach ($dishes as $dish)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card product_item">
                <div class="body">
                    <div class="cp_img">
                        <img src="{{ $dish->image }}" alt="Product" class="img-fluid w-100">
                        <div class="hover">
                            <a href="#" class="btn btn-secondary btn-sm waves-effect text-white w-25">
                                <i class="fas fa-info"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-success btn-sm waves-effect text-white w-25">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product_details">
                        <h5><a href="ec-product-detail.html">{{ $dish->name }}</a></h5>
                        <ul class="product_price list-unstyled">
                            <li class="old_price">€ {{ $dish->price }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection