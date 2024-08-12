<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LodgeFeed extends Model
{
    protected $fillable = [
        'lodge_id',
        'file',
    ];
}
