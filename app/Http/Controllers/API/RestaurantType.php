<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RestaurantResource;
use App\Restaurant;

class RestaurantType extends Controller
{
    public function index() {
        return RestaurantResource::collection(Restaurant::with('types')->paginate(10));
    }
}
