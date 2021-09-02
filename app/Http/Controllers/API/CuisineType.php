<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;

class CuisineType extends Controller
{
    public function index()
    {
        $types = Type::all();
        return $types;
    }
}
