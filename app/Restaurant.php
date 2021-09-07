<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'piva', 'image'
    ];

    protected $appends = ['type_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function dishes() {
        return $this->hasMany(Dish::class);
    }

    public function types() {
        return $this->belongsToMany(Type::class);
    }

    public function getTypeIdAttribute() {
        return $this->types()->pluck('type_id');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
