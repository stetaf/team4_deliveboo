<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Type;
use App\Dish;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::where('user_id', Auth::user()->id)->get();

        return view('admin.home', compact('restaurants'));
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'address' => 'required|max:255',
            'piva'    => 'required|max:11|min:11',
            'image'   => 'nullable|image|max:150',
            'types'   => 'required'
        ]);

        if(array_key_exists('image', $validated)){
            $file_path = Storage::disk('public')->put('restaurant_img', $validated['image']);
            $validated['image'] = $file_path;
        } else {
            $validated['image'] = 'restaurant_img/placeholder.jpg';
        }

        $restaurant = new Restaurant($validated);
        $restaurant->user()->associate(Auth::user()->id)->save();
        
        $restaurant->types()->sync($validated['types']);

        return redirect()->route('admin.restaurants.index')->with('message', "Nuovo ristorante $restaurant->name inserito!");
    }


    /**
     * Display the specified resource.
     *
     * @param  Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== Auth::user()->id) {
            abort(403, 'Access denied');
        }

        $dishes = Dish::where('restaurant_id', $restaurant->id)->orderBy('name', 'ASC')->get();
        
        return view('admin.restaurant.index', compact('dishes', 'restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /// TO BE CODED AS AN ADDITIONAL FUNCTIONALITY

        /*
        if ($restaurant->user_id !== Auth::user()->id) {
            abort(403, 'Access denied');
        }
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /// TO BE CODED AS AN ADDITIONAL FUNCTIONALITY
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== Auth::user()->id) {
            abort(403, 'Access denied');
        }

        //$restaurant->types()->sync([]);
        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')->with('message', "Ristorante $restaurant->name eliminato con successo!");
    }

    public function overview(Restaurant $restaurant) {
        
        $orders = Order::where('restaurant_id', $restaurant->id)->orderBy('created_at', 'DESC')->paginate(10);
            
        return view('admin.overview', compact('orders', 'restaurant'));
    }

    public function graphs(Restaurant $restaurant, Request $request) {
        $year = date('Y');

        $years = [
            $year - 2, $year - 1, $year - 0
        ];

        ($request->year) ? $year = $request->year : '';

        /* STATISTICHE VENDITE */
        $order_quantity = Order::select(DB::raw("MONTHNAME(created_at) month"), Order::raw('count(*) as total'), DB::raw('max(created_at) as createdAt'))
        ->where('restaurant_id', $restaurant->id)
        ->whereYear('created_at', $year)
        ->orderBy('createdAt', 'asc')
        ->groupBy('month')
        ->pluck('total', 'month',)->all();

        $chart_quantity = [
            'labels' => (array_keys($order_quantity)),
            'dataset' => (array_values($order_quantity))
        ];

        for( $g = 0; $g < sizeof($chart_quantity['labels']); $g++) {
            $chart_quantity['labels'][$g] = strval($chart_quantity['labels'][$g]); 
        }
        /* /STATISTICHE VENDITE */


        /* STATISTICHE INCASSI */
        $order_amount = Order::select(DB::raw("MONTHNAME(created_at) month"), Order::raw('sum(total) as amount'), DB::raw('max(created_at) as createdAt'))
                    ->where('restaurant_id', $restaurant->id)
                    ->whereYear('created_at', $year)
                    ->orderBy('createdAt', 'asc')
                    ->groupBy('month')
                    ->pluck('amount', 'month')->all();

        $chart_amount = [
            'labels' => (array_keys($order_amount)),
            'dataset' => (array_values($order_amount))
        ];

        for( $h = 0; $h < sizeof($chart_amount['labels']); $h++) {
            $chart_amount['labels'][$h] = strval($chart_amount['labels'][$h]); 
        }
        /* /STATISTICHE INCASSI */

        return view('admin.graphs', compact('restaurant', 'chart_quantity', 'chart_amount', 'year', 'years'));
    }
}
