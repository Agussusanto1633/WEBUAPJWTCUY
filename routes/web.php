<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\ServiceProviderWebController;
use App\Http\Controllers\Web\CategoryWebController;

// Halaman utama (landing page) - Public access
Route::get('/', function () {
    $serviceProviders = \App\Models\ServiceProvider::with('category')
        ->latest()
        ->take(6)
        ->get();
    $categories = \App\Models\Category::all();
    return view('welcome', compact('serviceProviders', 'categories'));
})->name('home');

// Authentication routes (Login jwt only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthWebController::class, 'login']);
    Route::get('/register', [AuthWebController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthWebController::class, 'register']);
});

// Protected routes (require authentication via web session)
Route::middleware('auth:web')->group(function () {
    // Auth
    Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Service Providers CRUD (protected routes JWT authentication)
    Route::prefix('service-providers')->name('service-providers.')->group(function () {
        Route::get('/', [ServiceProviderWebController::class, 'index'])->name('index');
        Route::get('/create', [ServiceProviderWebController::class, 'create'])->name('create');
        Route::post('/', [ServiceProviderWebController::class, 'store'])->name('store');
        Route::get('/{uuid}', [ServiceProviderWebController::class, 'show'])->name('show');
        Route::get('/{uuid}/edit', [ServiceProviderWebController::class, 'edit'])->name('edit');
        Route::put('/{uuid}', [ServiceProviderWebController::class, 'update'])->name('update');
        Route::delete('/{uuid}', [ServiceProviderWebController::class, 'destroy'])->name('destroy');
    });

    // Categories CRUD (protected routes JWT authentication)
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryWebController::class, 'index'])->name('index');
        Route::get('/create', [CategoryWebController::class, 'create'])->name('create');
        Route::post('/', [CategoryWebController::class, 'store'])->name('store');
        Route::get('/{uuid}', [CategoryWebController::class, 'show'])->name('show');
        Route::get('/{uuid}/edit', [CategoryWebController::class, 'edit'])->name('edit');
        Route::put('/{uuid}', [CategoryWebController::class, 'update'])->name('update');
        Route::delete('/{uuid}', [CategoryWebController::class, 'destroy'])->name('destroy');
    });
});
