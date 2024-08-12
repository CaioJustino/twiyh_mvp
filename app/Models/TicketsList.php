<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsList extends Model
{
    protected $fillable = [
        'ticket_id',
        'package_id',
    ];
}
