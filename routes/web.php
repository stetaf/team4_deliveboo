<?php

use App\Http\Middleware\VerifyUser;
use App\Mail\GuestOrderMail;
use App\Mail\UserOrderMail;
use App\Order;
use App\Restaurant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
Route::any('/restaurant/{id}/confirm', 'RestaurantController@confirm')->name('guests.restaurant.confirm');

Auth::routes();

Route::prefix('admin')
      ->namespace('Admin')
      ->name('admin.')
      ->middleware('auth')
      ->group(function() {
        Route::resource('restaurants', 'UserController');
        Route::get('restaurant/{restaurant}/overview', 'UserController@overview')->name('overview');
        Route::get('restaurant/{restaurant}/overview/graphs', 'UserController@graphs')->name('overview.graphs');
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

  $order_data = json_decode($request->order_data);
  $req_order = json_decode($request->order);  
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
    $order = new Order();
    $order->customer_email   = $req_order->customer_email;
    $order->customer_name    = $req_order->customer_name;
    $order->customer_phone   = $req_order->customer_phone;
    $order->customer_address = $req_order->customer_address;
    $order->notes            = $req_order->notes;
    $order->total            = $req_order->total;
    $order->status = '1';
    $order->restaurant()->associate($request->restaurant_id)->save();

    $order_dishes = [];

    foreach($order_data[1] as $dish) {
      $food = [ 'dish_id' => $dish->id, 'quantity' => $dish->quantity ];
      array_push($order_dishes, $food);
    }
  
    $order->dishes()->sync($order_dishes);

    $restaurant = Restaurant::find($request->restaurant_id);

    $user = User::find($restaurant->user_id);

    $mail = [
      'guest_name' => $order->customer_name,
      'guest_email' => $order->customer_email,
      'guest_phone' => $order->customer_phone,
      'guest_address' => $order->customer_address,
      'notes' => $order->notes,
      'restaurant_name' => $restaurant->name,
      'body' => [ 
        'order' => $order_data[1],
        'total_amount' => $order->total 
      ],
      'user_name' => $user->user,
      'user_email' => $user->email
      ];

    Mail::to($order->customer_email)
          ->send(new GuestOrderMail($mail));
          
    Mail::to($user->email)
    ->send(new UserOrderMail($mail));
      
    return redirect()->route('guests.restaurant.confirm', $request->restaurant_id)->with('message', 'Transaction successful. The ID is:'. $transaction->id);
  } else {
      $errorString = "";

      foreach ($result->errors->deepAll() as $error) {
          $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
      }

      return back()->withErrors('An error occurred with the message: '.$result->message);
  }
});
