<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category as Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CarModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll() {
    }

    public function add(Request $request) {
        $validRequest = $request->validate([
            'model_name'=>'required',
            'description'=>'required',
//            'photo' => 'required|mimes:jpg, jpeg, png'
            'photo' => 'required',
            'category_id' => 'required',
            'theBrand' => 'required',
        ]);

        $image = $request->file('photo');
        $generatedName = hexdec(uniqid());
        $imgExtension = strtolower($image->getClientOriginalExtension());
        $imgName = $generatedName.'.'.$imgExtension;
        $imgPathMd = 'images/carModels/md/';
        $imgMdPathAndName = $imgPathMd.$imgName;
        Image::make($image)->resize(300, null, function ($constraint){
            $constraint->aspectRatio();
        })->save($imgPathMd.$imgName);

        $generatedNameSm = hexdec(uniqid());
        $imgExtensionSm = strtolower($image->getClientOriginalExtension());
        $imgNameSm = $generatedNameSm.'.'.$imgExtensionSm;
        $imgPathSm = 'images/carModels/sm/';
        $imgSmPathAndName = $imgPathSm.$imgNameSm;
        Image::make($image)->resize(150, null, function ($constraint){
            $constraint->aspectRatio();
        })->save($imgPathSm.$imgNameSm);

        CarModel::insert([
            'model_name' => $request->model_name,
            'brand_id' => $request->theBrand,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'photo_sm' => $imgSmPathAndName,
            'photo_md' => $imgMdPathAndName,
            'created_at' =>Carbon::now()
        ]);
//        CarModel::create($validRequest);
        return redirect()->back()->with('success', 'Model was added successfully');
    }

    public function delete($id) {
        $carModel = CarModel::find($id);
        $cars = Car::where('car_model_id', $id)->get();

        if ($cars) {
            foreach ($cars as $car) {
                unlink($car->photo_sm);
                unlink($car->photo_md);
            }
        }

        unlink($carModel->photo_sm);
        unlink($carModel->photo_md);
        CarModel::find($id)->delete();
        return redirect()->back()->with('success', 'Model was deleted');
    }

    public function edit($id) {
        $carModel = CarModel::find($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('car-model-edit')->with(compact('carModel', 'brands', 'categories'));
    }

    public function update(Request $request, $id) {
        $validRequest = $request->validate([
            'model_name'=>'required',
            'description'=>'required',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);
        $old_photo_sm = $request->old_photo_sm;
        $old_photo_md = $request->old_photo_md;
        $image = $request->file('photo');

        if($image) {
            $generatedName = hexdec(uniqid());
            $imgExtension = strtolower($image->getClientOriginalExtension());
            $imgName = $generatedName.'.'.$imgExtension;
            $imgPathMd = 'images/carModels/md/';
            $imgMdPathAndName = $imgPathMd.$imgName;
            Image::make($image)->resize(600, null, function ($constraint){
                $constraint->aspectRatio();
            })->save($imgPathMd.$imgName);

            $generatedNameSm = hexdec(uniqid());
            $imgExtensionSm = strtolower($image->getClientOriginalExtension());
            $imgNameSm = $generatedNameSm.'.'.$imgExtensionSm;
            $imgPathSm = 'images/carModels/sm/';
            $imgSmPathAndName = $imgPathSm.$imgNameSm;
            Image::make($image)->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            })->save($imgPathSm.$imgNameSm);

            unlink($old_photo_sm);
            unlink($old_photo_md);

            CarModel::find($id)->update([
                'model_name' => strtolower($request->model_name),
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'photo_sm' => $imgSmPathAndName,
                'photo_md' => $imgMdPathAndName,
                'updated_at' =>Carbon::now()
            ]) ;
        } else {
            CarModel::find($id)->update([
                'model_name' => strtolower($request->model_name),
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'updated_at' =>Carbon::now()
            ]) ;
        }

        return redirect()->route('dashboard')->with('success', 'CarModel was updated');
    }
}
