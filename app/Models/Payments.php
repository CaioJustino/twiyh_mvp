<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
        'package_id',
        'paymethod_id',
        'datetime',
        'price',
    ];
}
