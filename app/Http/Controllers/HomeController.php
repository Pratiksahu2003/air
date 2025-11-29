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

    /**
     * Display Terms & Conditions page
     */
    public function terms()
    {
        return view('terms');
    }

    /**
     * Display Privacy Policy page
     */
    public function privacy()
    {
        return view('privacy');
    }

    /**
     * Display FAQs page
     */
    public function faqs()
    {
        return view('faqs');
    }

    /**
     * Display Payment Options page
     */
    public function paymentOptions()
    {
        return view('payment-options');
    }

    /**
     * Display Finance & Payment page
     */
    public function financePayment()
    {
        return view('finance-payment');
    }

    /**
     * Display Airlines page
     */
    public function airlines()
    {
        return view('airlines');
    }

    /**
     * Display Airports page
     */
    public function airports()
    {
        return view('airports');
    }

    /**
     * Display Blog page
     */
    public function blog()
    {
        return view('blog');
    }
}

