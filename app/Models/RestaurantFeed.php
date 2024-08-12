<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantFeed extends Model
{
    protected $fillable = [
        'restaurant_id',
        'file',
    ];
}
