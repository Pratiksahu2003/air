<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airpot extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'airports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'image',
        'country',
        'city',
        'continents',
        'airport_txt',
        'type',
        'Address',
        'Contact',
    ];

   
}
