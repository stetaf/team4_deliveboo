<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Dish;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function show($id) {
        $restaurant = Restaurant::findOrFail($id);
        $dishes = Dish::where('restaurant_id', '=', $id)->where('visible', '=', '1')->get();

        return view('guests.restaurant.show', compact('dishes', 'restaurant'));
    }

    public function checkout($id) {
        $restaurant = Restaurant::findOrFail($id);
      
        return view('guests.restaurant.checkout', compact('restaurant'));
    }

    public function pay($id) {
        $restaurant = Restaurant::findOrFail($id);

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
      
        $token = $gateway->ClientToken()->generate();
        
        return view('guests.restaurant.pay', compact('restaurant', 'token'));
    }
}
