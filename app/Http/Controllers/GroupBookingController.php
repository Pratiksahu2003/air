<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupBookingController extends Controller
{
    /**
     * Display the group booking page
     */
    public function index()
    {
        return view('group-booking.index');
    }
}

