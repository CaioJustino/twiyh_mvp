<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lodge extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'desc',
        'clients_amount',
        'kids',
        'pets',
        'breakfast',
        'gym',
        'pool',
        'rooms_amount',
        'price',
        'status',
    ];
}
