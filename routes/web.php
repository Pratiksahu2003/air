<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupBookingController;
use App\Http\Controllers\ContactController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Group Booking
Route::get('/group-booking', [GroupBookingController::class, 'index'])->name('group-booking.index');

// Other Pages
Route::get('/air-charter', [HomeController::class, 'airCharter'])->name('air-charter');
Route::get('/mice', [HomeController::class, 'mice'])->name('mice');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
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
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

