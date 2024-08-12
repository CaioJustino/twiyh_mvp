<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'desc',
        'amount',
        'start_datetime',
        'final_datetime',
        'price',
        'status',
    ];
}
