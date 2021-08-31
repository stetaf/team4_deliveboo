<?php

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

Auth::routes();

Route::prefix('admin')
      ->namespace('Admin')
      ->name('admin.')
      ->middleware('auth')
      ->group(function() {
        Route::resource('restaurants', 'UserController');
        Route::put('restaurant/{id}/dish/update', 'RestaurantController@Update')->name('dish.update');
        Route::post('restaurant/{id}/dish/store', 'RestaurantController@Store')->name('dish.store');
        Route::get('restaurant/{id}/dish/edit', 'RestaurantController@Edit')->name('dish.edit');
        Route::delete('restaurant/{id}/dish/delete', 'RestaurantController@Destroy')->name('dish.delete');
});   