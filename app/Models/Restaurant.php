<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'desc',
        'start_datetime',
        'final_datetime',
        'price',
        'status',
    ];
}
