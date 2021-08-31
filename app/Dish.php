<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ingredients', 'description', 'price', 'visible', 'image'
    ];

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
}
