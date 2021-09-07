<?php

use App\Http\Middleware\VerifyUser;
use Illuminate\Http\Request;
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

Route::get('/restaurant/{id}', 'RestaurantController@show')->name('guests.restaurant.show');
Route::get('/restaurant/{id}/checkout', 'RestaurantController@checkout')->name('guests.restaurant.checkout');
Route::any('/restaurant/{id}/pay', 'RestaurantController@pay')->name('guests.restaurant.pay');

Auth::routes();

Route::prefix('admin')
      ->namespace('Admin')
      ->name('admin.')
      ->middleware('auth')
      ->group(function() {
        Route::resource('restaurants', 'UserController');
        Route::post('restaurant/dish/{dish}/store', 'RestaurantController@Store')->name('dish.store');
        Route::get('restaurant/{restaurant}/dish/', 'RestaurantController@Create')->name('dish.create');
        Route::get('restaurant/dish/{dish}/show', 'RestaurantController@Show')->name('dish.show');
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

Route::post('/pay', function (Request $request) {
  $gateway = new Braintree\Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
  ]);

  $amount = $request->amount;
  $nonce = $request->payment_method_nonce;

  $result = $gateway->transaction()->sale([
      'amount' => $amount,
      'paymentMethodNonce' => $nonce,
      'customer' => [
          'firstName' => 'Tony',
          'lastName' => 'Stark',
          'email' => 'tony@avengers.com',
      ],
      'options' => [
          'submitForSettlement' => true
      ]
  ]);

  if ($result->success) {
      $transaction = $result->transaction;
      // header("Location: transaction.php?id=" . $transaction->id);

      return back()->with('message', 'Transaction successful. The ID is:'. $transaction->id);
  } else {
      $errorString = "";

      foreach ($result->errors->deepAll() as $error) {
          $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
      }

      // $_SESSION["errors"] = $errorString;
      // header("Location: index.php");
      return back()->withErrors('An error occurred with the message: '.$result->message);
  }
});
