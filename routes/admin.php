<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\AirlineController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\FlightEnquiryController;
use App\Http\Controllers\Admin\GroupBookingController;
use App\Http\Controllers\Admin\SettingsController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (public)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    
    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // User Management Routes (Admin only - check in controller)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        
        // Airport Management Routes (Admin only - check in controller)
        Route::get('/airports', [AirportController::class, 'index'])->name('airports.index');
        
        // Airline Management Routes (Admin only - check in controller)
        Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines.index');
        
        // Contact Enquiry Management Routes (Admin and Subadmin - check in controller)
        Route::get('/contact-enquiries', [ContactEnquiryController::class, 'index'])->name('contact-enquiries.index');
        
        // Flight Enquiry Management Routes (Admin and Subadmin - check in controller)
        Route::get('/flight-enquiries', [FlightEnquiryController::class, 'index'])->name('flight-enquiries.index');
        
        // Group Booking Management Routes (Admin and Subadmin - check in controller)
        Route::get('/group-bookings', [GroupBookingController::class, 'index'])->name('group-bookings.index');
        
        // Settings Routes (Admin only - check in controller)
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    });
});

