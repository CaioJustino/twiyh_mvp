<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    protected $fillable = [
        'client_id',
        'street',
        'number',
        'city',
        'state',
        'country',
    ];
}
