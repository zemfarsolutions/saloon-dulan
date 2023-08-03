<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = "tickets";
    protected $fillable = [
        'ticket_number',
      'session_id',
        'user_id',
        'section_id',
        'enqueue_time',
        'serving_time',
        'served_time',
        'is_discarded',
        'possible_serving',
        'is_appoint',
        'que_in'
    ];
}
