<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'id',
        'cnpj',
        'inn',
        'attraction',
        'restaurant',
        'guide',
        'car_rental',
    ];
}
