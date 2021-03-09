<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CarModelController extends Controller
{
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
        $brand = Brand::find($id);
        unlink($brand->photo_sm);
        unlink($brand->photo_md);
        CarModel::find($id)->delete();
        return redirect()->back()->with('success', 'Model was deleted');
    }
}
