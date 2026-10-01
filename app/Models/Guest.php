<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'phone',
        'email',
        'nic_passport',
        'tier',
        'total_stays',
        'lifetime_spend',
        'preferred_room',
        'notes',
    ];

    protected $casts = [
        'lifetime_spend' => 'decimal:2',
    ];
}
