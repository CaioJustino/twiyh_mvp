<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAddress extends Model
{
    protected $fillable = [
        'ticket_id',
        'street',
        'number',
        'city',
    ];
}
