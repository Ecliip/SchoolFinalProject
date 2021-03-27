<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UniversalGetAllController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UniversalGetAllController::class, 'getTenOfAll'])->name('home.page');

// rutas de categorías
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [CategoryController::class, 'showAll'])->name('dashboard');
Route::post('category/add', [CategoryController::class, 'add'])->name('add.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('delete.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('update.category');
// rutas de marca
Route::post('brand/add', [BrandController::class, 'add'])->name('add.brand');
Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('delete.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('update.brand');
// rutas de modelos de coches
Route::post('car-model/add', [CarModelController::class, 'add'])->name('add.car-model');
Route::get('/car-model/delete/{id}', [CarModelController::class, 'delete'])->name('delete.car-model');
Route::get('/car-model/edit/{id}', [CarModelController::class, 'edit'])->name('edit.car-model');
Route::post('/car-model/update/{id}', [CarModelController::class, 'update'])->name('update.car-model');
// rutas de modelos de coches
Route::get('cars', [CarsController::class, 'index'])->name('all.car');
Route::get('findCars', [CarsController::class, 'findCars'])->name('find.car');
Route::get('car/submit-form', [CarsController::class, 'showAddForm'])->name('submit-form.car')->middleware('auth');
Route::post('car/add', [CarsController::class, 'add'])->name('add.car')->middleware('auth');
Route::get('car/getModelsByBrandId/{id}', [CarsController::class, 'getModelsByBrandId'])->name('getByBrandId.car');
Route::get('car/info/{id}', [CarsController::class, 'showCar'])->name('info.car');
Route::get('car/edit/getModelsByBrandId/{id}', [CarsController::class, 'getModelsByBrandId'])->name('getByBrandId.edit.car')->middleware('auth');
Route::get('car/edit/{id}', [CarsController::class, 'edit'])->name('edit.car')->middleware('auth');
Route::get('car/delete/{id}', [CarsController::class, 'delete'])->name('delete.car')->middleware('auth');
Route::post('car/update/{id}', [CarsController::class, 'update'])->name('update.car')->middleware('auth');
// rutas de modelos de carrito
Route::get('cart', [CartController::class, 'index'])->name('all.cart');
Route::get('cart/add/{id}', [CartController::class, 'add'])->name('add.cart');
Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('delete.cart');

Route::get('/user/logout', [SessionController::class, 'logout'])->name('user.logout');
