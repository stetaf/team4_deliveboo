<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Type;
use App\Dish;

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

        return view('admin.home', compact('types'));
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
            'user_id' => 'exists:users,id',
            'image'   => 'nullable|image|max:150'
        ]);       

        $restaurant = new Restaurant($validated);
        $restaurant->user()->associate(Auth::user()->id)->save();
        
        //$restaurant->types()->attach($request->types);

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
}
