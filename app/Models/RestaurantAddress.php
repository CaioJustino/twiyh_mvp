<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantAddress extends Model
{
    protected $fillable = [
        'restaurant_id',
        'street',
        'number',
        'city',
    ];
}
