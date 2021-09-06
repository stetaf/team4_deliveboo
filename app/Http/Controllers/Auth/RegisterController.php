<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (array_key_exists('image', $data)) {
            $file_path = Storage::disk('public')->put('restaurant_img', $data['image']);
            $data['image'] = $file_path;
        } 

        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'piva' => ['required', 'numeric', 'regex:/^[0-9]{11}$/'],
            'tipologie' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
                    'fullname' => $data['fullname'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);        

        (array_key_exists('image', $data)) ? '' : $data['image'] = 'restaurant_img/placeholder.jpg';

        $restaurant = new Restaurant($data);                    
        $restaurant->user()->associate($user)->save();
        $restaurant->types()->attach($data['tipologie']);

        return $user;
    }
}
