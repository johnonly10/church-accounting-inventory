<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware(['auth'])->group(function () {
    // common auth routes here
});

// Pastor-only routes
Route::middleware(['auth', 'roletype:PASTOR'])
    ->prefix('pastor')
    ->name('pastor.')
    ->group(function () {
        Route::view('/', 'pastor.index')->name('index');
    });

// Staff-only routes
Route::middleware(['auth', 'roletype:STAFF'])->prefix('staff')->name('staff.')->group(function () {
    Route::view('/', 'staff.index')->name('index');

    Route::resource('users', UserController::class)->names('users');
});

require __DIR__ . '/auth.php';
