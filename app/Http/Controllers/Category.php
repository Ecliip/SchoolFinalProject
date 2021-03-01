<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Category extends Controller
{
    public function add(Request $request) {
        $request->validate([
            'category'=>'required|min:5',
            'description'=>'required|min:10|max:2000',
        ]);

        const $image =


        $category = new Category();
        $category->category = $request->category;
        $category->description = $request->description;
        $category->save();
    }
}
