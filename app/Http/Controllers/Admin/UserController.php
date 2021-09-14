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
use Illuminate\Support\Carbon;

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
     * @param  Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== Auth::user()->id) {
            abort(403, 'Access denied');
        }
        $types = Type::all();

        return view('admin.edit', compact('restaurant', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'address' => 'required|max:255',
            'piva'    => 'required|max:11|min:11',
            'image'   => 'nullable|image|max:150',
            'types'   => 'required'
        ]);


        if ($request->hasFile('image')) {
            Storage::delete($restaurant->image);
            $image = Storage::disk('public')->put('restaurant_img', $request->image);
            $validated['image'] = $image;
            
            $restaurant->image = $validated['image'];
        }   

        $restaurant->update($validated);        
        $restaurant->types()->sync($validated['types']);

        return redirect()->route('admin.restaurants.index')->with('message', "Ristorante $restaurant->name modificato!");
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
        if ($request->year == 'summary' || !$request->year) {
            $years = Order::select(DB::raw("DISTINCT YEAR(`created_at`) AS 'Year'"))
                        ->orderByDesc('Year')
                        ->get();

            $year = 's';

            $start_date = date('Y-m-d', strtotime('-1 year'));
            $final_date = date('Y-m-d');
                    
            $order_quantity = Order::select(DB::raw("MONTHNAME(created_at) month"), DB::raw("YEAR(created_at) year"), Order::raw('count(*) as total'), DB::raw('max(created_at) as createdAt'))
                            ->where('restaurant_id', $restaurant->id)
                            ->whereDate('created_at', '>=', $start_date)
                            ->whereDate('created_at', '<=', $final_date)
                            ->orderBy('createdAt', 'asc')
                            ->groupBy('month', 'year')
                            ->get();

            $order_quantity->flatten()->all();        
            $orders = json_decode($order_quantity);

            if (sizeof($orders) > 0) {
                $keys = [];
    
                for ($l = 0; $l < sizeof($orders); $l++) {
                    array_push($keys, $orders[$l]->year . ' ' . $orders[$l]->month);
                }
                
                $counter = 0;
                for ($i = strtotime($keys[0]); $i <= strtotime(end($keys)); $i += 86400*31){
                    $search = array_search(date("Y F", $i), $keys);
                    if($search !== false){
                        if ($counter < sizeof($orders)) {
                            $new[$keys[$search]] = $orders[$counter]->total;
                            $counter += 1;
                        }
                    }else{
                        $new[date("Y F", $i)] = 0;
                    }
                }
    
                json_encode($new); // 1
    
                $order_amount = Order::select(DB::raw("MONTH(created_at) month"), DB::raw("YEAR(created_at) year"), Order::raw('sum(total) as amount'), DB::raw('max(created_at) as createdAt'))
                                ->where('restaurant_id', $restaurant->id)
                                ->whereDate('created_at', '>=', $start_date)
                                ->whereDate('created_at', '<=', $final_date)
                                ->orderBy('createdAt', 'asc')
                                ->groupBy('month', 'year')
                                ->get();
    
                $order_amount->flatten()->all();        
                $orders = json_decode($order_amount);
                    
                $counter = 0;
    
                for ($h = strtotime($keys[0]); $h <= strtotime(end($keys)); $h += 86400*31){
                    $search = array_search(date("Y F", $h), $keys);
                    if($search !== false){
                        if ($counter < sizeof($orders)) {
                            $new2[$keys[$search]] = floatval($orders[$counter]->amount);
                            $counter += 1;
                        }
                    }else{
                        $new2[date("Y F", $h)] = 0;
                    }
                }
                json_encode($new2); // 2
    
                return view('admin.graphs', compact('restaurant', 'new', 'new2', 'years', 'year'));
            } else {
                $new = [];
                $new2 = [];

                return view('admin.graphs', compact('restaurant', 'new', 'new2', 'years', 'year'));
            }
        } else {     
            $year = $request->year;

            $years = Order::select(DB::raw("DISTINCT YEAR(`created_at`) AS 'Year'"))
                        ->orderByDesc('Year')
                        ->get();

            $order_quantity = Order::select(DB::raw("MONTH(created_at) month"), Order::raw('count(*) as total'), DB::raw('max(created_at) as createdAt'))
                            ->where('restaurant_id', $restaurant->id)
                            ->whereYear('created_at', $year)
                            ->orderBy('createdAt', 'asc')
                            ->groupBy('month')
                            ->get();

            $order_quantity->flatten()->all();        
            $orders = json_decode($order_quantity);

            $dati = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            for ($h = 0; $h < sizeof($orders); $h++) {
                $dati[($orders[$h]->month)-1] = $orders[$h]->total;
            }

            $order_amount = Order::select(DB::raw("MONTH(created_at) month"), Order::raw('sum(total) as amount'), DB::raw('max(created_at) as createdAt'))
                            ->where('restaurant_id', $restaurant->id)
                            ->whereYear('created_at', $year)
                            ->orderBy('createdAt', 'asc')
                            ->groupBy('month')
                            ->get();

            $order_amount->flatten()->all();        

            $orders_2 = json_decode($order_amount);

            $dati_2 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            for ($g = 0; $g < sizeof($orders_2); $g++) {
                $dati_2[($orders[$g]->month)-1] = floatval($orders_2[$g]->amount);
            }

            return view('admin.graphs', compact('restaurant', 'dati', 'dati_2', 'years', 'year'));
        }
    }
}
