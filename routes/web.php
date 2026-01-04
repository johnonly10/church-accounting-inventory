<?php

use App\Http\Controllers\LeaderController;
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
    Route::resource('leaders', LeaderController::class)->names('leaders');
    Route::get('leaders-archive', [LeaderController::class, 'archived'])->name('leaders.archived');
    Route::patch('leaders/{leader}/archive', [LeaderController::class, 'archive'])->name('leaders.archive');
    Route::patch('leaders/{id}/restore', [LeaderController::class, 'restore'])->name('leaders.restore');
    Route::delete('leaders/{id}/force-delete', [LeaderController::class, 'forceDelete'])->name('leaders.forceDelete');
});

require __DIR__ . '/auth.php';
