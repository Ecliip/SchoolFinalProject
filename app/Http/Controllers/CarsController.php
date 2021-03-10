<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
        $myRequest =$request->validate([
            'price' => 'required',
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
            'image' => 'required',
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
            'image.required'=> 'Tiene que elegir una imagen',
        ]);

        $image = $request->file('image');
        $generatedName = hexdec(uniqid());
        $imgExtension = strtolower($image->getClientOriginalExtension());
        $imgName = $generatedName.'.'.$imgExtension;
        $imgPathMd = 'images/cars/md/';
        $imgMdPathAndName = $imgPathMd.$imgName;
        Image::make($image)->resize(600, null, function ($constraint){
            $constraint->aspectRatio();
        })->save($imgPathMd.$imgName);

        $generatedNameSm = hexdec(uniqid());
        $imgExtensionSm = strtolower($image->getClientOriginalExtension());
        $imgNameSm = $generatedNameSm.'.'.$imgExtensionSm;
        $imgPathSm = 'images/cars/sm/';
        $imgSmPathAndName = $imgPathSm.$imgNameSm;
        Image::make($image)->resize(300, null, function ($constraint){
            $constraint->aspectRatio();
        })->save($imgPathSm.$imgNameSm);



        Car::insert([
            'price' => $request->price,
            'engine'=> $request->engine,
            'power_hp'=> $request->power_hp,
            'kilometers'=> $request->kilometers,
            'doors'=> $request->doors,
            'transmission'=> $request->transmission,
            'traccion'=> $request->traccion,
            'year'=> $request->year,
            'isNew'=> $request->isNew,
            'isSold'=> $request->isSold,
            'category_id'=> $request->category_id,
            'brand_id'=> $request->brand_id,
            'car_model_id'=> $request->car_model_id,

            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'photo_md'=> $imgMdPathAndName,
            'photo_sm'=> $imgSmPathAndName,
        ]);
        return redirect()->route('all.car')->with('success', 'car added');
    }

    public function getModelsByBrandId($id) {

//        $models = CarModel::all();
        $models = CarModel::where('brand_id', $id)->get();
        return response()->json($models);
    }
}
