<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dish;
use App\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        return view('admin.restaurant.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $restaurant)
    {
        $validated = $request->validate([
            'name'         => 'required|max:100',
            'ingredients'  => 'required',
            'description'  => 'required',
            'price'        => 'required|between:0,999.99',
            'visible'      => 'required|integer|max:1|min:0',
            'image'        => 'nullable|image'
        ]);       

        $dish = new Dish($validated);
        $dish->restaurant()->associate($restaurant)->save();
        
        return redirect()->route('admin.restaurants.show', $restaurant)->with('message', "Nuovo piatto $dish->name inserito!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::find($id);

        return view('admin.restaurant.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = Dish::find($id);

        return view('admin.restaurant.edit', compact('dish'));
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
        $dish = Dish::find($id);

        $validated = $request->validate([
            'name'         => 'required|max:100',
            'ingredients'  => 'required',
            'description'  => 'required',
            'price'        => 'required|between:0,999.99',
            'visible'      => 'required|boolean',
            'image'        => 'nullable|image'
        ]);
        
        $dish->update($validated);
        
        return redirect()->back()->with('message', "Piatto $dish->name modificato correttamente!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);
        $dish->delete();
    
        return redirect()->back()->with('message', "Piatto $dish->name eliminato correttamente!");;
    }
}
