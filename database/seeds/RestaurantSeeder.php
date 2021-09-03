<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $images = [
            "/img/restaurants/cafe.jpg", "/img/restaurants/cafe_2.jpg", "/img/restaurants/rest.jpg", "/img/restaurants/rest_2.jpg"
        ];

        for ($i = 0; $i < 5; $i++) {
            $r = new Restaurant;
            $r->user_id = 1;
            $r->name = 'Ristorante da ' . $faker->name();
            $r->address = $faker->address();
            $r->piva = '11111111111';
            $r->image = $faker->randomElement($images);
            $r->save();
            for ($h = 0; $h < mt_rand(1, 2); $h++) {
                $types = mt_rand(1,12);
                $r->types()->attach($types);
            }
        }
    }
}
