<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
//    protected $guarded = [
//        'photo_md',
//        'photo_sm',
//        'created_at'
//    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }
}
