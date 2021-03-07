<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index() {
        $cars = Car::latest()->simplePaginate(10);
        return view('cars')->with(compact('cars'));
    }

    public function showAddForm() {
        return view('car-submit-form');
    }

    public function add() {
        return view('car-submit-form');
    }
}
