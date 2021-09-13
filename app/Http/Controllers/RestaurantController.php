<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Dish;
use App\Order;
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

    public function pay($id, Request $request) {
        
        $restaurant = Restaurant::findOrFail($id);

        $validated = $request->validate([
            'customer_email'     => 'required|string|email|max:255',
            'customer_name'      => 'required|max:255',
            'customer_phone'     => 'required|numeric|min:10|max:10',
            'customer_address'   => 'required|max:255',
            'notes'              => 'nullable',
            'total'              => 'required|numeric|between:0,9999.99'
        ]);       

        $order = $validated;

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
      
        $token = $gateway->ClientToken()->generate();

        $order_total = $validated['total'];
        
        return view('guests.restaurant.pay', compact('restaurant', 'token', 'order', 'order_total'));
    }

    public function confirm() {
        return view('guests.restaurant.confirm');
    }
}
