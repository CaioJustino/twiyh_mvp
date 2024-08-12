<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketFeed extends Model
{
    protected $fillable = [
        'ticket_id',
        'file',
    ];
}
