<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $cars = Car::find(Auth::user()->id);
        return view('cart')->with(compact($cars));
    }
}
