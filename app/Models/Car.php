<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function carModel() {
        return $this->belongsTo(CarModel::class);
    }

    public function brands() {
        return $this->belongsTo(Brand::class);
    }

    public function categories() {
        return $this->belongsTo(Category::class);
    }

}
