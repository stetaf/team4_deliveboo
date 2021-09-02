<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User;
        $u->fullname = 'admin';
        $u->email = 'admin@example.com';
        $u->password = Hash::make('123');
        $u->save();
    }
}
