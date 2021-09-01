<?php

namespace App\Http\Middleware;

use App\Dish;
use App\Restaurant;
use Closure;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $dish = Dish::find($request->route('dish'));
        $restaurant = Restaurant::find($dish->restaurant->id);
        $user_id = $restaurant->user_id;

        if ( $request->user()->id !== $user_id ) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
