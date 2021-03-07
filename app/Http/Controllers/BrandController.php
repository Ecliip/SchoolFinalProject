<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function showAll() {
        $brands = Brand::latest()->paginate(2);
        return view('dashboard')->with(compact('brands'));
    }

    public function add(Request $request) {
        $request->validate([
            'brand'=>'required|min:5',
            'description'=>'required|min:10|max:2000',
//            'photo' => 'required|mimes:jpg, jpeg, png'
            'photo' => 'required'
        ]);

        $image = $request->file('photo');
        $generatedName = hexdec(uniqid());
        $imgExtension = strtolower($image->getClientOriginalExtension());
        $imgName = $generatedName.'.'.$imgExtension;
        $imgPathMd = 'images/brands/md/';
        $imgMdPathAndName = $imgPathMd.$imgName;
        Image::make($image)->resize(600, null, function ($constraint){
            $constraint->aspectRatio();
        })->save($imgPathMd.$imgName);

        $generatedNameSm = hexdec(uniqid());
        $imgExtensionSm = strtolower($image->getClientOriginalExtension());
        $imgNameSm = $generatedNameSm.'.'.$imgExtensionSm;
        $imgPathSm = 'images/brands/sm/';
        $imgSmPathAndName = $imgPathSm.$imgNameSm;
        Image::make($image)->resize(300, null, function ($constraint){
            $constraint->aspectRatio();
        })->save($imgPathSm.$imgNameSm);

        Brand::insert([
            'brand' => $request->brand,
            'description' => $request->description,
            'photo_sm' => $imgSmPathAndName,
            'photo_md' => $imgMdPathAndName,
            'created_at' =>Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand was added successfully');
    }

    public function delete($id) {
        $brand = Brand::find($id);
        unlink($brand->photo_sm);
        unlink($brand->photo_md);
        Brand::find($id)->delete();
        return redirect()->back()->with('success', 'Brand was deleted');
    }
}