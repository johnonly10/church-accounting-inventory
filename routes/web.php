<?php

use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FinanceDashboard;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RevenueTypeController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpensePDFControlleer;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\FinanceDashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevenueCashCountController;
use App\Http\Controllers\RevenueCollectionController;
use App\Http\Controllers\SignatureController;
use App\Models\Signature;

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

    // Users Routes
    Route::resource('users', UserController::class)->names('users');

    // Leader Routes
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

    // Position Routes
    Route::resource('positions', PositionController::class);
    Route::get('position-archive', [PositionController::class, 'archived'])->name('positions.archived');
    Route::patch('positions/{position}/archive', [PositionController::class, 'archive'])->name('positions.archive');
    Route::patch('positions/{id}/restore', [PositionController::class, 'restore'])->name('positions.restore');
    Route::delete('positions/{id}/force-delete', [PositionController::class, 'forceDelete'])->name('positions.forceDelete');

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

    // Expense Category Routes
    Route::get('expense-category/archive',  [ExpenseCategoryController::class, 'archived'])->name('expense-categories.archived');
    Route::patch('expense-category/{expenseCategory}/archive', [ExpenseCategoryController::class, 'archive'])->name('expense-categories.archive');
    Route::patch('expense-category/{id}/restore', [ExpenseCategoryController::class, 'restore'])->name('expense-categories.restore');
    Route::delete('expense-category/{id}/force-delete', [ExpenseCategoryController::class, 'forceDelete'])->name('expense-categories.forceDelete');
    Route::resource('expense-category', ExpenseCategoryController::class)->names('expense-categories');

    // Categories Routes
    Route::resource('categories', CategoryController::class);
    Route::get('category-archive', [CategoryController::class, 'archived'])->name('categories.archived');
    Route::patch('category/{category}archive', [CategoryController::class, 'archive'])->name('categories.archive');
    Route::patch('category/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('category/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    // Expenses Routes
    Route::resource('expenses', ExpenseController::class);
    Route::get('expense-archive', [ExpenseController::class, 'archived'])->name('expenses.archived');
    Route::patch('expense/{expense}/archive', [ExpenseController::class, 'archive'])->name('expenses.archive');
    Route::patch('expense/{id}/restore', [ExpenseController::class, 'restore'])->name('expenses.restore');
    Route::delete('expense/{id}/force-delete', [ExpenseController::class, 'forceDelete'])->name('expenses.forceDelete');

    Route::resource('finance-dashboard', FinanceDashboardController::class)->names('finance-dashboard');

    Route::resource('images', ImageController::class);

    Route::resource('signatures', SignatureController::class);
    Route::get('signatures-archives', [SignatureController::class, 'archived'])->name('signatures.archived');
    Route::patch('signatures/{signature}/archive', [SignatureController::class, 'archive'])->name('signatures.archive');
    Route::patch('signatures/{id}/restore', [SignatureController::class, 'restore'])->name('signatures.restore');
    Route::delete('signatures/{id}/force-delete', [SignatureController::class, 'forceDelete'])->name('signatures.forceDelete');

    // Reports for Expenses
    Route::get('/expense-reports', [ExpenseReportController::class, 'index'])->name('expense-reports.index');

    // PDF FOR Expenses
    Route::get('/staff/expense-reports/pdf', [ExpensePDFControlleer::class, 'index'])->name('expense-reports.pdf');

    // Rrevenue Cash Count
    Route::resource('revenue-cash-counts', RevenueCashCountController::class);
    Route::get('revenueCashCount', [RevenueCashCountController::class, 'archived'])->name('revenue-cash-counts.archived');
    Route::patch('revenueCashCounts/{revenueCashCounts}/archived', [RevenueCashCountController::class, 'archive'])->name('revenue-cash-counts.archive');
    Route::patch('revenueCashCounts/{id}/restore', [RevenueCashCountController::class, 'restore'])->name('revenue-cash-counts.restore');
    Route::delete('revenueCashCounts/{id}/force-delete', [RevenueCashCountController::class, 'forceDelete'])->name('revenue-cash-counts.forceDelete');

    Route::resource('profile', ProfileController::class);
});

require __DIR__ . '/auth.php';
