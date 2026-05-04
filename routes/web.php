<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, ProductController, OrderController, DashboardController, UserController};
use App\Http\Controllers\Auth\GoogleController;
use App\Models\Product;
use App\Http\Controllers\ProfileController;

// Pastikan kode ini ada di dalam file routes/web.php
Route::middleware(['auth'])->group(function () {
    // Route untuk menampilkan halaman profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
    // Route untuk memproses update info profil
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// --- Landing Page ---
Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});

// --- Rute Auth ---
Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// --- User (Authenticated) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    
    // PERBAIKAN: Ditambahkan ->name('orders.index') agar sesuai dengan view success
    Route::get('/history', [OrderController::class, 'history'])->name('orders.index');
    
    Route::get('/checkout/{id}', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [OrderController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{id}', [OrderController::class, 'success'])->name('checkout.success');
});

// --- Rute Admin (Unified & Cleaned Up) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard & Analytics
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    
    // Product Management
    Route::resource('products', ProductController::class);
    
    // Order Management untuk Admin
    Route::get('/orders', [OrderController::class, 'adminOrders'])->name('orders.index');
    Route::post('/orders/confirm/{id}', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    
    // --- ROUTE BARU: Mengubah status pembelian ---
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    
    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users');
});