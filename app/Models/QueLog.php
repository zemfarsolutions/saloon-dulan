<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueLog extends Model
{
    use HasFactory;
    protected $table = "que_log";
    protected $fillable = [
        'ticket_id',
        'user_id',
        'section_id',
        'que_status'
    ];
}
