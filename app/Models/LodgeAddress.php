<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LodgeAddress extends Model
{
    protected $fillable = [
        'lodge_id',
        'street',
        'number',
        'city',
    ];
}
