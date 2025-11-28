<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupBookingController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Group Booking
Route::get('/group-booking', [GroupBookingController::class, 'index'])->name('group-booking.index');

// Other Pages
Route::get('/air-charter', [HomeController::class, 'airCharter'])->name('air-charter');
Route::get('/mice', [HomeController::class, 'mice'])->name('mice');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/fix-departure', [HomeController::class, 'fixDeparture'])->name('fix-departure');

