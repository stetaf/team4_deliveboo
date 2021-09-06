<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            $d = new Dish;
            $d->name = $faker->word();
            $d->restaurant_id = rand(1, 5);
            $d->ingredients = $faker->paragraph(2);
            $d->description = $faker->paragraph(3);
            $d->price = $faker->randomFloat(2, 0, 999);
            $d->visible = true;
            $d->image = 'dish_img/placeholder.jpg';
            $d->save();
        }
    }
}
