<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RevenueCashCountController;
use App\Http\Controllers\RevenueCollectionController;
use App\Http\Controllers\RevenueTypeController;

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

    // Department Routes
    Route::resource('departments', DepartmentController::class)->names('departments');
    Route::get('deparments-archive', [DepartmentController::class, 'archived'])->name('departments.archived');
    Route::patch('departments/{department}/archive', [DepartmentController::class, 'archive'])->name('departments.archive');
    Route::patch('department/{id}/restore', [DepartmentController::class, 'restore'])->name('departments.restore');
    Route::delete('departments/{id}/force-delete', [DepartmentController::class, 'forceDelete'])->name('departments.forceDelete');

    // Ministry Routes
    Route::resource('ministries', MinistryController::class)->names('ministries');
    Route::get('ministries-archive', [MinistryController::class, 'archived'])->name('ministries.archived');
    Route::patch('ministries/{ministry}/archive', [MinistryController::class, 'archive'])->name('ministries.archive');
    Route::patch('ministries{id}/restore', [MinistryController::class, 'restore'])->name('ministries.restore');
    Route::delete('ministries/{id}/force-delete', [MinistryController::class, 'forceDelete'])->name('ministries.forceDelete');

    // Revenue Type Routes
    Route::resource('revenue-types', RevenueTypeController::class)->names('revenue-types');
    Route::get('revenue-types-archive', [RevenueTypeController::class, 'archived'])->name('revenue-types.archived');
    Route::patch('revenue-types/{revenueType}/archive', [RevenueTypeController::class, 'archive'])->name('revenue-types.archive');
    Route::patch('revenue-type/{id}/restore', [RevenueTypeController::class, 'restore'])->name('revenue-types.restore');
    Route::delete('revenue-type/{id}/delete', [RevenueTypeController::class, 'forceDelete'])->name('revenue-type.forceDelete');

    // Revenue Routes
    Route::resource('revenues', RevenueController::class)->names('revenues');
    Route::get('revenues-archive', [RevenueController::class, 'archived'])->name('revenues.archived');
    Route::patch('revenues/{revenue}/archive', [RevenueController::class, 'archive'])->name('revenues.archive');
    Route::patch('revenues/{id}/restore', [RevenueController::class, 'restore'])->name('revenues.restore');
    Route::delete('revenues/{id}/force-delete', [RevenueController::class, 'forceDelete'])->name('revenues.forceDelete');

    Route::resource('revenue_collections', RevenueCollectionController::class)
        ->names('staff.revenue_collections');

    Route::resource('revenue_cash_counts', RevenueCollectionController::class)->names('revenue_cash_counts');
});

require __DIR__ . '/auth.php';
