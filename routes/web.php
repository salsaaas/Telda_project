<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;   // Non-Pots
use App\Http\Controllers\OTCController;
use App\Http\Controllers\NonpotsController;
use App\Http\Controllers\PotsController;      // Pots

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Catatan:
| - products.byCategory     -> Non-Pots (ProductController)
| - potproducts.byCategory  -> Pots (PotsController, query ke products tapi filter kategori)
| - Halaman Non-Pots & Pots dilindungi auth.
*/

// ===============================
// Public (guest) - Auth Pages
// ===============================
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// ===============================
// Public - AJAX JSON
// ===============================

// Non-Pots: filter produk per kategori
Route::get('/products/by-category', [ProductController::class, 'byCategory'])
    ->name('products.byCategory');

// Legacy (opsional) Non-Pots: produk by {categoryId}
Route::get('/products/category/{categoryId}', [ProductController::class, 'getByCategory'])
    ->name('products.getByCategory');

// POTS: endpoint Select2 khusus halaman Pots
Route::get('/pot-products/by-category', [PotsController::class, 'productsByCategory'])
    ->name('potproducts.byCategory');

// ===============================
// Protected (auth required)
// ===============================
Route::middleware('auth')->group(function () {

    // Non-Pots pages
    Route::get('/nonpots', [NonpotsController::class, 'index'])->name('nonpots.index');
    Route::post('/nonpots', [NonpotsController::class, 'store'])->name('nonpots.store');
    Route::post('/nonpots/print-pdf', [NonpotsController::class, 'printPdf'])->name('nonpots.print-pdf');

    // Pots pages
    Route::get('/pots', [PotsController::class, 'index'])->name('pots.index');
    Route::post('/pots', [PotsController::class, 'store'])->name('pots.store');                   // jika dipakai
    Route::post('/pots/print-pdf', [PotsController::class, 'printPdf'])->name('pots.print-pdf'); // jika dipakai

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ===============================
// Redirect Root
// ===============================
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('nonpots.index')
        : redirect()->route('login');
});
