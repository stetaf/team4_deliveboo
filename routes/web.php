<?php

use App\Http\Middleware\VerifyUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('guests.home');
})->name('home');


Auth::routes();

Route::prefix('admin')
      ->namespace('Admin')
      ->name('admin.')
      ->middleware('auth')
      ->group(function() {
        Route::resource('restaurants', 'UserController');
        Route::post('restaurant/dish/{dish}/store', 'RestaurantController@Store')->name('dish.store');
        Route::get('restaurant/{restaurant}/dish/', 'RestaurantController@Create')->name('dish.create');
      });   
      
Route::prefix('admin')
      ->namespace('Admin')
      ->name('admin.')
      ->middleware(['auth', VerifyUser::class])
      ->group(function() {
        Route::put('restaurant/dish/{dish}/update', 'RestaurantController@Update')->name('dish.update');
        Route::get('restaurant/dish/{dish}/edit', 'RestaurantController@Edit')->name('dish.edit');
        Route::delete('restaurant/dish/{dish}/delete', 'RestaurantController@Destroy')->name('dish.delete');
});   