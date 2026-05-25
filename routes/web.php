<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpensePDFControlleer;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\FinanceDashboardController;
use App\Http\Controllers\FinancePDFController;
use App\Http\Controllers\FinanceReportController;
use App\Http\Controllers\Guest\AboutController;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Member\MProfileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Leader\LDashboardController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\Leader\LEventController;
use App\Http\Controllers\Leader\LPepsolCategoriesController;
use App\Http\Controllers\Leader\LPepsolController;
use App\Http\Controllers\Leader\LPepsolTypes;
use App\Http\Controllers\Leader\LPepsolTypesController;
use App\Http\Controllers\Leader\LSilderController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevenueCashCountController;
use App\Http\Controllers\RevenueCollectionController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\RevenuePDFController;
use App\Http\Controllers\RevenueReportController;
use App\Http\Controllers\RevenueTypeController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\UserController;
use App\Livewire\Auth\ForgotPassword;
use App\Models\ExpenseCategory;
use App\Models\Signature;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;



// Route::get('/', fn() => redirect()->route('login'));
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::resource('/contact', ContactController::class)->names('contact');

Route::get('/maintenance', function () {
    return view('maintenance');
})->name('maintenance.index');


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

    Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');




// Member Routes

Route::middleware(['auth', 'roletype:MEMBER'])->prefix('member')->name('member.')->group(function () {
    Route::resource('profiles', MProfileController::class);
});


// Leader Routes

Route::middleware(['auth', 'roletype:LEADER'])->prefix('leader')->name('leader.')->group(function () {

    Route::get('/', [LDashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('images', ImageController::class);

    Route::resource('events', LEventController::class);


    Route::resource('pepsol-categories', LPepsolCategoriesController::class);
    Route::get('pepsol-categories-archive', [LPepsolCategoriesController::class, 'archived'])->name('pepsol-categories.archived');
    Route::patch('pepsol-categories/{pepsolCategory}/archive', [LPepsolCategoriesController::class, 'archive'])->name('pepsol-categories.archive');
    Route::patch('pepsol-categories/{id}/restore', [LPepsolCategoriesController::class, 'restore'])->name('pepsol-categories.restore');
    Route::delete('pepsol-categories/{id}/force-delete', [LPepsolCategoriesController::class, 'forceDelete'])->name('pepsol-categories.forceDelete');

    Route::resource('pepsol-types', LPepsolTypesController::class);
    Route::get('pepsol-types-archive', [LPepsolTypesController::class, 'archived'])->name('pepsol-types.archived');
    Route::patch('pepsol-types/{pepsolType}/archive', [LPepsolTypesController::class, 'archive'])->name('pepsol-types.archive');
    Route::patch('pepsol-types/{id}/restore', [LPepsolTypesController::class, 'restore'])->name('pepsol-types.restore');
    Route::delete('pepsol=types/{id}/force-delete', [LPepsolTypesController::class, 'forceDelete'])->name('pepsol-types.forceDelete');


    Route::resource('pepsol', LPepsolController::class);

    Route::resource('sliders', LSilderController::class);
});


// Pastor-only routes
Route::middleware(['auth', 'roletype:PASTOR'])->prefix('pastor')->name('pastor.')->group(function () {
    Route::view('/', 'pastor.index')->name('index');
});

// Staff-only routes
Route::middleware(['auth', 'roletype:STAFF'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/', [FinanceDashboardController::class, 'index'])->name('index');

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

    // MAIN DASHBOARD
    Route::resource('finance-dashboard', FinanceDashboardController::class)->names('finance-dashboard');

    // IMAGES


    // SIGNATURES
    Route::resource('signatures', SignatureController::class);
    Route::get('signatures-archives', [SignatureController::class, 'archived'])->name('signatures.archived');
    Route::patch('signatures/{signature}/archive', [SignatureController::class, 'archive'])->name('signatures.archive');
    Route::patch('signatures/{id}/restore', [SignatureController::class, 'restore'])->name('signatures.restore');
    Route::delete('signatures/{id}/force-delete', [SignatureController::class, 'forceDelete'])->name('signatures.forceDelete');

    // Reports for Expenses
    Route::get('/expense-reports', [ExpenseReportController::class, 'index'])->name('expense-reports.index');
    // Reports for Revenues
    Route::get('revenue-reports', [RevenueReportController::class, 'index'])->name('revenue-reports.index');
    // Reports for Both
    Route::get('finance-reports', [FinanceReportController::class, 'index'])->name('finance-reports.index');


    // PDF FOR Expenses
    Route::get('/staff/expense-reports/pdf', [ExpensePDFControlleer::class, 'index'])->name('expense-reports.pdf');
    // PDF FOR REVENUES
    Route::get('revenues-reports/pdf', [RevenuePDFController::class, 'index'])->name('revenues-reports.pdf');
    // PDF FOR FINANCE
    Route::get('finance-report/pdf', [FinancePDFController::class, 'index'])->name('finance-report.pdf');


    // Rrevenue Cash Count
    Route::resource('revenue-cash-counts', RevenueCashCountController::class);
    Route::get('revenueCashCount', [RevenueCashCountController::class, 'archived'])->name('revenue-cash-counts.archived');
    Route::patch('revenueCashCounts/{revenueCashCounts}/archived', [RevenueCashCountController::class, 'archive'])->name('revenue-cash-counts.archive');
    Route::patch('revenueCashCounts/{id}/restore', [RevenueCashCountController::class, 'restore'])->name('revenue-cash-counts.restore');
    Route::delete('revenueCashCounts/{id}/force-delete', [RevenueCashCountController::class, 'forceDelete'])->name('revenue-cash-counts.forceDelete');

    // ADMIN PROFILE
    Route::resource('profile', ProfileController::class);
});

require __DIR__ . '/auth.php';

