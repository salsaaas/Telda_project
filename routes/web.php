<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OTCController;
use App\Http\Controllers\CalculatorController;

// API Routes
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::post('products/{id}/calculate-price', [ProductController::class, 'calculatePrice']);
Route::get('products/category/{categoryId}', [ProductController::class, 'getByCategory']);
Route::apiResource('otcs', OTCController::class);
Route::get('otcs/category/{category}', [OTCController::class, 'getByCategory']);

// Web Routes
Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');
Route::post('/calculator', [CalculatorController::class, 'store'])->name('calculator.store');
Route::post('/calculator/print-pdf', [CalculatorController::class, 'printPdf'])->name('calculator.print-pdf');

// Default route redirect to calculator
Route::get('/', function () {
    return redirect()->route('calculator.index');
});