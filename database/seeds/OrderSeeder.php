<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $d = new Order;
            $d->restaurant_id = 1;
            $d->customer_name = $faker->name();
            $d->customer_email = $faker->email();
            $d->customer_phone = '3333333333';
            $d->customer_address = $faker->address();
            $d->notes = '';
            $d->total = $faker->randomFloat(2, 1, 100);
            $d->status = 1;
            $d->created_at = $faker->dateTime('now', 'UTC'); 
            $d->updated_at = $faker->dateTime('now', 'UTC'); 
            $d->save();
        }
    }
}
