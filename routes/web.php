<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AdminController;

// Redirect root ke dashboard atau login
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    // Redirect ke admin dashboard jika admin, ke user dashboard jika user biasa
    return auth()->user()->isAdmin() 
        ? redirect()->route('admin.dashboard') 
        : redirect()->route('dashboard');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    // User-only Routes (tidak untuk admin)
    Route::middleware(\App\Http\Middleware\NotAdmin::class)->group(function () {
        // Dashboard untuk user biasa
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Transaksi
        Route::resource('transaksi', TransaksiController::class);

        // Budget
        Route::resource('budget', BudgetController::class)->only(['index', 'store', 'update', 'destroy']);
    });

    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::put('/users/{user}', [AdminController::class, 'updateUsername'])->name('users.update');
        
        // API Endpoints
        Route::get('/api/online-count', [AdminController::class, 'getOnlineCount'])->name('api.online');
        Route::get('/api/total-count', [AdminController::class, 'getTotalCount'])->name('api.total');
        Route::post('/api/update-activity', [AdminController::class, 'updateActivity'])->name('api.activity');
    });
});

