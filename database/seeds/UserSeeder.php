<?php

use Illuminate\Database\Seeder;
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
        $u->name = 'admin';
        $u->email = 'admin@example.com';
        $u->password = '123';
        $u->save();
    }
}
