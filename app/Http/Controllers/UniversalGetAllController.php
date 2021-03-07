<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversalGetAllController extends Controller
{
    public function getTenOfAll() {
        $categories = Category::take(8)->get();
        $brands = Brand::take(8)->get();
        $models = CarModel::take(8)->get();

        return view('welcome')->with(compact('categories', 'brands', 'models'));
    }
}
