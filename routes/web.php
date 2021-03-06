<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home.page');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [CategoryController::class, 'showAll'])->name('dashboard');
Route::post('category/add', [CategoryController::class, 'add'])->name('add.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('delete.category');

Route::post('brand/add', [BrandController::class, 'add'])->name('add.brand');
Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('delete.brand');


Route::get('/user/logout', [SessionController::class, 'logout'])->name('user.logout');
