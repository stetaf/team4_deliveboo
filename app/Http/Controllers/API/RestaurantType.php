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

    public function type_filter($id = 1) {
        //$collection = RestaurantResource::collection(Restaurant::with('types')->paginate());    

        // $res = Restaurant::with(array('types' => function($query) use($id)
        // {
        //     $query->where('type_id', '=', $id);

        // }))->paginate();
         
        $restaurants = Restaurant::with(['types' => function($query) use($id){
            $query->select(['restaurant_id', 'type_id'])
                  ->where('type_id', '=', $id);
        }])
        ->get();

        dd($restaurants);

    }
}
