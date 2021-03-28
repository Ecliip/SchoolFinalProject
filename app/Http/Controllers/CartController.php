<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarCart;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $userCartId = Cart::firstWhere('user_id', Auth::user()->id);
        $cars = CarCart::where('cart_id', $userCartId->id)->get();
        $carsArr = array();

        $totalPrice = 0;
        foreach ($cars as $car) {
            $theCar = Car::find($car);
            array_push($carsArr, $theCar[0]);
            $carColl = collect($theCar);
            $totalPrice += $carColl[0]->price;
        }
        return view('cart')->with(compact('carsArr', 'userCartId', 'totalPrice'));
    }

    public function add($id) {
        $record = CarCart::where('car_id', $id)->first();
        if ($record == null) {
            $cart = Cart::firstWhere('user_id', Auth::user()->id);
            if (!$cart) {
                Cart::insert([
                    'user_id' => Auth::user()->id,
                ]);
            }

            CarCart::insert([
                'car_id' => $id,
                'cart_id' =>Auth::user()->cart->id,
            ]);
            return redirect()->back()->with('success', 'Has agregado el coche a tu carrito');
        } else {
            return redirect()->back()->with('Ya existe', 'El coche ya está agregado');
        }
    }

    public function delete($id) {
        CarCart::firstWhere('cart_id', Auth::user()->cart->id)->firstWhere('car_id', $id)->delete();
        return redirect()->back();
    }
}


