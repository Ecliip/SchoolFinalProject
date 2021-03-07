<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Category as Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
// TODO have to manage exceptions https://laravel.com/docs/8.x/errors#the-exception-handler
    public function showAll() {
        $categories = Category::latest()->simplePaginate(2);
        $brands = Brand::latest()->simplePaginate(2);
        $carModels = CarModel::latest()->simplePaginate(2);
        return view('dashboard')->with(compact('categories', 'brands', 'carModels'));
    }

    public function add(Request $request) {
        $request->validate([
            'category'=>'required|min:5',
            'description'=>'required|min:10|max:2000',
//            'photo' => 'required|mimes:jpg, jpeg, png'
            'photo' => 'required'
        ]);

        $image = $request->file('photo');
        $generatedName = hexdec(uniqid());
        $imgExtension = strtolower($image->getClientOriginalExtension());
        $imgName = $generatedName.'.'.$imgExtension;
        $imgPathMd = 'images/categories/md/';
        $imgMdPathAndName = $imgPathMd.$imgName;
        Image::make($image)->resize(600, null, function ($constraint){
            $constraint->aspectRatio();
        })->save($imgPathMd.$imgName);

        $generatedNameSm = hexdec(uniqid());
        $imgExtensionSm = strtolower($image->getClientOriginalExtension());
        $imgNameSm = $generatedNameSm.'.'.$imgExtensionSm;
        $imgPathSm = 'images/categories/sm/';
        $imgSmPathAndName = $imgPathSm.$imgNameSm;
        Image::make($image)->resize(300, null, function ($constraint){
            $constraint->aspectRatio();
        })->save($imgPathSm.$imgNameSm);

        Category::insert([
            'category' => $request->category,
            'description' => $request->description,
            'photo_sm' => $imgSmPathAndName,
            'photo_md' => $imgMdPathAndName,
            'created_at' =>Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Category was added successfully');
    }

    public function delete($id) {
        $category = Category::find($id);
        unlink($category->photo_sm);
        unlink($category->photo_md);
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category was deleted');
    }
}
