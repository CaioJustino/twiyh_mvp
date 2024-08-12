<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'client_id',
        'start_datetime',
        'final_datetime',
        'price',
        'status',
    ];
}
