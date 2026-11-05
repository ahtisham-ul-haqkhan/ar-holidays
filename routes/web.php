<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Customer Management Routes
Route::resource('customers', CustomerController::class);

// Vendor Management Routes (Prefix & Controller Group)
Route::prefix('vendors')->name('vendors.')->controller(VendorController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{vendor}', 'show')->name('show');
    Route::get('/{vendor}/edit', 'edit')->name('edit');
    Route::put('/{vendor}', 'update')->name('update');
    Route::delete('/{vendor}', 'destroy')->name('destroy');
});
