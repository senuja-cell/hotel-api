<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'guest',
        'phone',
        'email',
        'room_number',
        'room_type',
        'check_in',
        'check_out',
        'nights',
        'total',
        'status',
        'payment_status',
        'guests_count',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total' => 'decimal:2',
    ];
}
