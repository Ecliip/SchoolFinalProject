<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarsController;
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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [CategoryController::class, 'showAll'])->name('dashboard');
Route::post('category/add', [CategoryController::class, 'add'])->name('add.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('delete.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('update.category');

Route::post('brand/add', [BrandController::class, 'add'])->name('add.brand');
Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('delete.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('update.brand');

Route::post('car-model/add', [CarModelController::class, 'add'])->name('add.car-model');
Route::get('/car-model/delete/{id}', [CarModelController::class, 'delete'])->name('delete.car-model');
Route::get('/car-model/edit/{id}', [CarModelController::class, 'edit'])->name('edit.car-model');
Route::post('/car-model/update/{id}', [CarModelController::class, 'update'])->name('update.car-model');

Route::get('cars', [CarsController::class, 'index'])->name('all.car');
Route::get('car/submit-form', [CarsController::class, 'showAddForm'])->name('submit-form.car');
Route::post('car/add', [CarsController::class, 'add'])->name('add.car');
Route::get('car/getModelsByBrandId/{id}', [CarsController::class, 'getModelsByBrandId'])->name('getByBrandId.car');
Route::get('car/info/{id}', [CarsController::class, 'showCar'])->name('info.car');
Route::get('car/edit/getModelsByBrandId/{id}', [CarsController::class, 'getModelsByBrandId'])->name('getByBrandId.edit.car');
Route::get('car/edit/{id}', [CarsController::class, 'edit'])->name('edit.car');
Route::post('car/update/{id}', [CarsController::class, 'update'])->name('update.car');


Route::get('/user/logout', [SessionController::class, 'logout'])->name('user.logout');
