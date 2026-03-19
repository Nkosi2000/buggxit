<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDressController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;

// ================== ADMIN ROUTES ================== //
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Public Authentication Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('login');
    
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.post');

       // Password reset routes
    Route::get('/password/reset', [AdminPasswordResetController::class, 'requestForm'])
        ->name('password.request');
    
    Route::post('/password/email', [AdminPasswordResetController::class, 'sendResetLink'])
        ->name('password.email');
    
    Route::get('/password/reset/{token}', [AdminPasswordResetController::class, 'resetForm'])
        ->name('password.reset');
    
    Route::post('/password/reset', [AdminPasswordResetController::class, 'reset'])
        ->name('password.update');

    // Protected routes - manually check auth in controllers
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/dashboard/clear-cache', [AdminDashboardController::class, 'clearCache'])
        ->name('dashboard.clear-cache');

    // Dress Management
    Route::prefix('dresses')->name('dresses.')->group(function () {
        Route::get('/', [AdminDressController::class, 'index'])
            ->name('index');
        
        Route::get('/create', [AdminDressController::class, 'create'])
            ->name('create');
        
        Route::post('/', [AdminDressController::class, 'store'])
            ->name('store');
        
        Route::get('/{dress}', [AdminDressController::class, 'show'])
            ->name('show');
        
        Route::get('/{dress}/edit', [AdminDressController::class, 'edit'])
            ->name('edit');
        
        Route::put('/{dress}', [AdminDressController::class, 'update'])
            ->name('update');
        
        Route::delete('/{dress}', [AdminDressController::class, 'destroy'])
            ->name('destroy');
        
        Route::patch('/{dress}/toggle-featured', [AdminDressController::class, 'toggleFeatured'])
            ->name('toggle-featured');
        
        Route::patch('/{dress}/update-status', [AdminDressController::class, 'updateStatus'])
            ->name('update-status');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('update-status');
    });

    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');
});