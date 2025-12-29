<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;

Route::get('/', fn() => redirect()->route('login'));


Route::middleware(['auth'])->group(function () {});

// Pastor-only routes
Route::middleware(['auth', 'roletype:PASTOR'])->prefix('pastor')->group(function () {});

// Staff-only routes
Route::middleware(['auth', 'roletype:STAFF'])->prefix('staff')->group(function () {});

require __DIR__ . '/auth.php';
