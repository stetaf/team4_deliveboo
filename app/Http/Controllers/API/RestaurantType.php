<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RestaurantResource;
use App\Restaurant;

class RestaurantType extends Controller
{
    public function index() {
        return RestaurantResource::collection(Restaurant::with('types')->paginate());
    }

    public function type_filter($id) {
        //$collection = RestaurantResource::collection(Restaurant::with('types')->paginate());

        $restaurants = Restaurant::whereHas('types', function ($q) use ($id) {
            $q->where('id', $id);
        })->paginate(4);

        return RestaurantResource::collection($restaurants);
    }
}
