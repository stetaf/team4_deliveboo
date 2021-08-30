<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Italiano',
                'img' => 'italian.png'
            ],
            [
                'name' => 'Cinese',
                'img' => 'asian-food.png'
            ],
            [
                'name' => 'Giapponese',
                'img' => 'japanese-food.png'
            ],
            [
                'name' => 'Messicano',
                'img' => 'taco.png'
            ],
            [
                'name' => 'Carne',
                'img' => 'roast-chicken.png'
            ],
            [
                'name' => 'Pesce',
                'img' => 'fish.png'
            ],
            [
                'name' => 'Pizza',
                'img' => 'pizza.png'
            ],
            [
                'name' => 'Vegano',
                'img' => 'salad.png'
            ],
            [
                'name' => 'Fast Food',
                'img' => 'fast-food.png'
            ],
            [
                'name' => 'Indiano',
                'img' => 'curry.png'
            ],
            [
                'name' => 'Pasticceria',
                'img' => 'dessert.png'
            ],
            [
                'name' => 'Kebab',
                'img' => 'doner-kebab.png'
            ]
        ];
        
        for ($i = 0; $i < 12; $i++) {
            $t = new Type;
            $t->name = $types[$i]['name'];
            $t->image = $types[$i]['img'];
            $t->save();
        }
    }
}
