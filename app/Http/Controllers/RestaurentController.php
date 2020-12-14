<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurent;

class RestaurentController extends Controller
{
    //
    public function index()
    {
    	return Restaurent::all();

    }
}
