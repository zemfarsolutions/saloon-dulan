<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = "appointments";
    protected $fillable = [
        'name',
        'phone',
        'email',
        'ticket_id',
        'hairdresser_id',
        'is_served'
    ];
}
