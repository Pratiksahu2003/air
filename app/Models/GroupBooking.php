<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_city',
        'to_city',
        'departure_date',
        'return_date',
        'passengers',
        'name',
        'email',
        'phone',
        'organization',
        'requirements',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
    ];
}
