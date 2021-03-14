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
// TODO create admin-pages for Categories/Brands/Model/Cars/
    public function showAll() {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $carModels = CarModel::latest()->get();
        return view('dashboard')->with(compact('categories', 'brands', 'carModels'));
    }

    public function add(Request $request) {
        $request->validate([
            'cat_name'=>'required|min:3',
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
            'cat_name' => strtolower($request->cat_name),
            'description' => $request->description,
            'photo_sm' => $imgSmPathAndName,
            'photo_md' => $imgMdPathAndName,
            'created_at' =>Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Category was added successfully');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('category-edit')->with(compact('category'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'cat_name'=>'required|min:3',
            'description'=>'required|min:10|max:2000',
        ]);

        $old_photo_sm = $request->old_photo_sm;
        $old_photo_md = $request->old_photo_md;
        $image = $request->file('photo');


        if($image) {
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

            unlink($old_photo_sm);
            unlink($old_photo_md);

            Category::find($id)->update([
                'cat_name' => strtolower($request->cat_name),
                'description' => $request->description,
                'updated_at' => Carbon::now(),
                'photo_sm' => $imgSmPathAndName,
                'photo_md' => $imgMdPathAndName,
            ]) ;
        } else {


            Category::find($id)->update([
                'cat_name' => strtolower($request->cat_name),
                'description' => $request->description,
                'updated_at' => Carbon::now(),
            ]) ;
        }

        return redirect()->route('dashboard')->with('success', 'Category was updated');
    }

    public function delete($id) {
        $category = Category::find($id);
        unlink($category->photo_sm);
        unlink($category->photo_md);
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category was deleted');
    }
}
