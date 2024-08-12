<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LodgeList extends Model
{
    protected $fillable = [
        'lodge_id',
        'package_id',
        'start_date',
        'final_date',
        'price',
    ];
}
