<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPasswordResetController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ReportController;

// Landing Page Route
Route::get('/', function () {
    $menus = Menu::where('visible', true)->orderBy('order')->get();
    return view('pages.landing', compact('menus'));
});

Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now(),
        'environment' => app()->environment(),
    ]);
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (only for guests)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');

        // Password reset routes
        Route::get('/password/reset', [AdminPasswordResetController::class, 'requestForm'])->name('password.request');
        Route::post('/password/email', [AdminPasswordResetController::class, 'sendResetLink'])->name('password.email');
        Route::get('/password/reset/{token}', [AdminPasswordResetController::class, 'resetForm'])->name('password.reset');
        Route::post('/password/reset', [AdminPasswordResetController::class, 'reset'])->name('password.update');
    });

    // Protected routes (only for authenticated admins)
    Route::middleware('auth:admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Products
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Product Variants - NESTED ROUTES (FIXED)
        Route::prefix('products/{product}/variants')->name('products.variants.')->group(function () {
            Route::get('/create', [ProductVariantController::class, 'create'])->name('create');
            Route::post('/', [ProductVariantController::class, 'store'])->name('store');
            Route::put('/{variant}', [ProductVariantController::class, 'update'])->name('update');
            Route::delete('/{variant}', [ProductVariantController::class, 'destroy'])->name('destroy');
        });

        // Discounts
        Route::get('/discounts', [DiscountController::class, 'index'])->name('discounts.index');
        Route::get('/discounts/create', [DiscountController::class, 'create'])->name('discounts.create');
        Route::post('/discounts', [DiscountController::class, 'store'])->name('discounts.store');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});