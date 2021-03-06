<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dish;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;

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

           
        if(array_key_exists('image', $validated)){
            $file_path = Storage::disk('public')->put('dish_img', $validated['image']);
            $validated['image'] = $file_path;
        } else { 
            $validated['image'] = 'dish_img/placeholder.jpg';
        }

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

        if ($request->hasFile('image')) {
            if ($dish->image !== 'dish_img/placeholder.jpg') {
                Storage::delete($dish->image);
            }
            $image = Storage::disk('public')->put('dish_img', $request->image);
            $validated['image'] = $image;

            $dish->image = $validated['image'];
        }

        $dish->update($validated);
        $restaurant = $dish->restaurant;

        return redirect()->route('admin.restaurants.show', compact('restaurant'))->with('message', "Piatto $dish->name modificato correttamente!");
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
