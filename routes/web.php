<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupBookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FlightSearchController;
use App\Http\Controllers\BlogController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Group Booking
Route::get('/group-booking', [GroupBookingController::class, 'index'])->name('group-booking.index');
Route::post('/group-booking/submit', [GroupBookingController::class, 'submit'])->name('group-booking.submit');

// Other Pages
Route::get('/air-charter', [HomeController::class, 'airCharter'])->name('air-charter');
Route::get('/mice', [HomeController::class, 'mice'])->name('mice');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Flight Search
Route::post('/flight-search/submit', [FlightSearchController::class, 'submit'])->name('flight-search.submit');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/fix-departure', [HomeController::class, 'fixDeparture'])->name('fix-departure');

// Footer Pages
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/payment-options', [HomeController::class, 'paymentOptions'])->name('payment-options');
Route::get('/finance-payment', [HomeController::class, 'financePayment'])->name('finance-payment');
Route::get('/airlines', [HomeController::class, 'airlines'])->name('airlines');
Route::get('/airports', [HomeController::class, 'airports'])->name('airports');
Route::get('/api/airports', [HomeController::class, 'getAirports'])->name('api.airports');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{slug}', [BlogController::class, 'tag'])->name('blog.tag');

