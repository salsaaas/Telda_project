<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OTCController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// ===============================
// API Routes
// ===============================

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::post('products/{id}/calculate-price', [ProductController::class, 'calculatePrice']);
Route::get('products/category/{categoryId}', [ProductController::class, 'getByCategory']);
Route::apiResource('otcs', OTCController::class);
Route::get('otcs/category/{category}', [OTCController::class, 'getByCategory']);

// ===============================
// Web Routes (Butuh Login)
// ===============================

Route::middleware('auth')->group(function () {
    Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');
    Route::post('/calculator', [CalculatorController::class, 'store'])->name('calculator.store');
    Route::post('/calculator/print-pdf', [CalculatorController::class, 'printPdf'])->name('calculator.print-pdf');

    // Logout hanya bisa dilakukan saat login
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ===============================
// Auth Routes (Khusus Guest)
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
// Redirect Root Berdasarkan Login
// ===============================

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('calculator.index')
        : redirect()->route('login');
});
