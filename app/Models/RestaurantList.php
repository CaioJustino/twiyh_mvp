<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantsList extends Model
{
    protected $fillable = [
        'restaurant_id',
        'package_id',
    ];
}