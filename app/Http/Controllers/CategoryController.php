<?php

namespace App\Http\Controllers;

use App\Models\Category as Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showAll() {
        $categories = Category::latest()->paginate(2);
        return view('dashboard')->with(compact('categories'));
    }

    public function add(Request $request) {
        $request->validate([
            'category'=>'required|min:5',
            'description'=>'required|min:10|max:2000',
//            'photo' => 'required|mimes:jpg, jpeg, png'
        ]);

        $image = $request->file('photo');
        $generatedName = hexdec(uniqid());
        $imgExtension = strtolower($image->getClientOriginalExtension());
        $imgName = $generatedName.'.'.$imgExtension;
        $imgPath = 'images/categories/';
        $imgPathAndName = $imgPath.$imgName;
        $image->move($imgPath, $imgName);


        Category::insert([
            'category' => $request->category,
            'description' => $request->description,
            'photo_sm' => $imgPathAndName,
            'photo_md' => $imgPathAndName,
            'created_at' =>Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Category was added successfully');
    }

    public function delete($id) {
        $category = Category::find($id);
        unlink($category->photo_sm);
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category was deleted');
    }
}
