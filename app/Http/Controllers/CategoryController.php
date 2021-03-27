<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category as Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    // gestiona Categorias, marca, modelos y abre la página de panel de control
    public function showAll() {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $carModels = CarModel::latest()->get();
        return view('dashboard')->with(compact('categories', 'brands', 'carModels'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    //agregar carrocería nueva
    public function add(Request $request) {
        $request->validate([
            'cat_name'=>'required|min:3',
            'description'=>'required|min:10|max:2000',
            'photo' => 'required'
        ]);
        // guarda las imagenes y cambia el tamaño
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    // sirve el formulario para modificar una categoría
    public function edit($id) {
        $category = Category::find($id);
        return view('category-edit')->with(compact('category'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // actualiza una categoría
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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // eliminar una categoría
    public function delete($id) {
        $category = Category::find($id);

        $cars = Car::where('category_id', $id)->get();
        $carModels = CarModel::where('category_id', $id)->get();

        if ($cars) {
            foreach ($cars as $car) {
                unlink($car->photo_sm);
                unlink($car->photo_md);
            }
        }
        if ($carModels) {
            foreach ($carModels  as $model) {
                unlink($model->photo_sm);
                unlink($model->photo_md);
            }
        }

        unlink($category->photo_sm);
        unlink($category->photo_md);
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category was deleted');
    }
}
