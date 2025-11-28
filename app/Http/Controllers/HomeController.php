<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display Air Charter page
     */
    public function airCharter()
    {
        return view('air-charter');
    }

    /**
     * Display MICE page
     */
    public function mice()
    {
        return view('mice');
    }

    /**
     * Display Contact page
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Display About page
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display Services page
     */
    public function services()
    {
        return view('services');
    }

    /**
     * Display Fix Departure page
     */
    public function fixDeparture()
    {
        return view('fix-departure');
    }
}

