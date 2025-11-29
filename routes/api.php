<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\AirlineController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\FlightEnquiryController;
use App\Http\Controllers\Admin\GroupBookingController;
use App\Http\Controllers\Admin\SettingsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Admin API Routes
Route::prefix('admin')->name('admin.api.')->middleware(['web', 'admin'])->group(function () {
    // User Management API Routes (Admin only)
    Route::get('/users', [UserController::class, 'getUsers'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Airport Management API Routes (Admin only)
    Route::get('/airports', [AirportController::class, 'getAirports'])->name('airports.index');
    Route::post('/airports', [AirportController::class, 'store'])->name('airports.store');
    Route::get('/airports/{id}', [AirportController::class, 'show'])->name('airports.show');
    Route::put('/airports/{id}', [AirportController::class, 'update'])->name('airports.update');
    Route::delete('/airports/{id}', [AirportController::class, 'destroy'])->name('airports.destroy');
    
    // Airline Management API Routes (Admin only)
    Route::get('/airlines', [AirlineController::class, 'getAirlines'])->name('airlines.index');
    Route::post('/airlines', [AirlineController::class, 'store'])->name('airlines.store');
    Route::get('/airlines/{id}', [AirlineController::class, 'show'])->name('airlines.show');
    Route::match(['put', 'post'], '/airlines/{id}', [AirlineController::class, 'update'])->name('airlines.update');
    Route::delete('/airlines/{id}', [AirlineController::class, 'destroy'])->name('airlines.destroy');
    
    // Contact Enquiry Management API Routes (Admin and Subadmin)
    Route::get('/contact-enquiries', [ContactEnquiryController::class, 'getContactEnquiries'])->name('contact-enquiries.index');
    Route::get('/contact-enquiries/{id}', [ContactEnquiryController::class, 'show'])->name('contact-enquiries.show');
    Route::delete('/contact-enquiries/{id}', [ContactEnquiryController::class, 'destroy'])->name('contact-enquiries.destroy');
    
    // Flight Enquiry Management API Routes (Admin and Subadmin)
    Route::get('/flight-enquiries', [FlightEnquiryController::class, 'getFlightEnquiries'])->name('flight-enquiries.index');
    Route::get('/flight-enquiries/{id}', [FlightEnquiryController::class, 'show'])->name('flight-enquiries.show');
    Route::delete('/flight-enquiries/{id}', [FlightEnquiryController::class, 'destroy'])->name('flight-enquiries.destroy');
    
    // Group Booking Management API Routes (Admin and Subadmin)
    Route::get('/group-bookings', [GroupBookingController::class, 'getGroupBookings'])->name('group-bookings.index');
    Route::get('/group-bookings/{id}', [GroupBookingController::class, 'show'])->name('group-bookings.show');
    Route::delete('/group-bookings/{id}', [GroupBookingController::class, 'destroy'])->name('group-bookings.destroy');
    
    // Settings API Routes (Admin only)
    Route::get('/settings', [SettingsController::class, 'getConfig'])->name('settings.index');
    Route::match(['put', 'post'], '/settings', [SettingsController::class, 'update'])->name('settings.update');
});

