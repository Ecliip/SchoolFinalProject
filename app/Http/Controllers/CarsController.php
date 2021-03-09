<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index() {
        $cars = Car::latest()->simplePaginate(10);
        return view('cars')->with(compact('cars'));
    }

    public function showAddForm() {
        $categories = Category::all();
        $brands = Brand::all();

        return view('car-submit-form')->with(compact('categories', 'brands'));
    }

    public function add(Request $request) {
        $request->validate([
            'price' => 'required|min:200|max:1000000',
            'engine'=> 'required',
            'power_hp'=> 'required',
            'kilometers'=> 'required',
            'doors'=> 'required',
            'transmission'=> 'required',
            'traccion'=> 'required',
            'year'=> 'required',
            'isNew'=> 'required',
            'isSold'=> 'required',
            'category_id'=> 'required',
            'brand_id'=> 'required',
            'car_model_id'=> 'required',
        ],
        [
            'price.required' => 'Tiene que introducir un precio',
            'engine.required'=> 'Tiene que elegir un tipo',
            'power_hp.required'=> 'Tiene que introducir',
            'kilometers.required'=> 'Tiene que introducir',
            'doors.required'=> 'Tiene que introducir',
            'transmission.required'=> 'Tiene que elegir un tipo de transmisión',
            'traccion.required'=> 'Tiene que introducir',
            'year.required'=> 'Tiene que introducir',
            'isNew.required'=> 'Tiene que introducir',
            'isSold.required'=> 'Tiene que introducir',
            'category_id.required'=> 'Tiene que elegir un tipo de carrocería',
            'brand_id.required'=> 'Tiene que elegir su marca',
            'car_model_id.required'=> 'Tiene que elegir un modelo',
        ]
        );

        return redirect()->route('all.car')->with('success', 'car added');
    }

    public function getModelsByBrandId($id) {

//        $models = CarModel::all();
        $models = CarModel::where('brand_id', $id)->get();
        return response()->json($models);
    }
}
