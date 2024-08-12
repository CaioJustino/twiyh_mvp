<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayMethod extends Model
{
    protected $fillable = [
        'client_id',
        'type_id',
        'card_number',
        'card_validity',
        'cvc',
    ];
}
