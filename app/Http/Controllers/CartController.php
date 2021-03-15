<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarCart;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $userCartId = Cart::first('user_id', Auth::user()->id);
        $cars = CarCart::where('cart_id', $userCartId->user_id)->get();
        $carsArr = array();
        foreach ($cars as $car) {
            $theCar = Car::find($car);
            array_push($carsArr, $theCar);
        }

        return view('cart')->with(compact('carsArr'));
    }

    public function add($id) {
        CarCart::insert([
            'car_id' => $id,
            'cart_id' =>Auth::user()->cart->id,
        ]);
        return redirect()->back()->with('success', 'Has agregado el coche a tu carrito');
    }
}
