<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;
    protected $table = "session";
    protected $fillable = [
        'session_start_at',
        'session_end_at',
        'session_status'
    ];
}