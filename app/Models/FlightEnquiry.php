<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_type',
        'from_city',
        'to_city',
        'departure_date',
        'return_date',
        'adults',
        'children',
        'infants',
        'contact_number',
        'email',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'adults' => 'integer',
        'children' => 'integer',
        'infants' => 'integer',
    ];
}
