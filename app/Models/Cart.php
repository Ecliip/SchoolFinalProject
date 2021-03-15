<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    pubic function user() {
        return $this->hasOne(User::class);
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }
}