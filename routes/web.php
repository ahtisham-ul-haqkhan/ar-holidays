<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VisaCategoryController;
use Illuminate\Support\Facades\Route;

// Authentication Routes (Guest)
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
});

// Authenticated System Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Password Management (Modal Submission)
    Route::post('/change-password', [AuthController::class, 'updatePassword'])->name('password.update');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Customer Management Routes
    Route::resource('customers', CustomerController::class);

    // Vendor / Airline Management Routes (Prefix & Controller Group)
    Route::prefix('vendors')->name('vendors.')->controller(VendorController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{vendor}', 'show')->name('show');
        Route::get('/{vendor}/edit', 'edit')->name('edit');
        Route::put('/{vendor}', 'update')->name('update');
        Route::delete('/{vendor}', 'destroy')->name('destroy');
    });

    // Flight Ticket Management (Create Route Only as requested)
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');

    // Visa Category Management Routes
    Route::prefix('visa-categories')->name('visa-categories.')->controller(VisaCategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{visaCategory}', 'show')->name('show');
        Route::get('/{visaCategory}/edit', 'edit')->name('edit');
        Route::put('/{visaCategory}', 'update')->name('update');
        Route::delete('/{visaCategory}', 'destroy')->name('destroy');
    });
});
