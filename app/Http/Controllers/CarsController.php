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
//        $models = CarModel::all();

        return view('car-submit-form')->with(compact('categories', 'brands'));
    }

    public function add() {
        return view('car-submit-form');
    }

    public function getModelsByBrandId($id) {

//        $models = CarModel::all();
        $models = CarModel::where('brand_id', $id)->get();
        return response()->json($models);
    }
}
