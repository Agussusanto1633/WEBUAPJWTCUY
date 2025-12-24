<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes - Jasa Cuci Mobil & Motor
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return response()->json([
        'message' => 'Koneksi Jasa API - Jasa Cuci Mobil & Motor',
        'version' => '1.0.0',
        'theme' => 'Jasa Cuci Mobil & Motor',
        'endpoints' => [
            'auth' => [
                'POST /api/register' => 'Register new user',
                'POST /api/login' => 'Login user',
            ],
            'protected' => [
                'POST /api/logout' => 'Logout user (requires auth)',
                'GET /api/me' => 'Get current user (requires auth)',
                'POST /api/refresh' => 'Refresh token (requires auth)',
            ]
        ]
    ]);
});

// Authentication routes (public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require JWT authentication)
Route::middleware('auth:api')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    // Service Providers CRUD (protected)
    Route::apiResource('service-providers', ServiceProviderController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy'])
        ->names([
            'index' => 'api.service-providers.index',
            'store' => 'api.service-providers.store',
            'show' => 'api.service-providers.show',
            'update' => 'api.service-providers.update',
            'destroy' => 'api.service-providers.destroy',
        ]);

    // Categories CRUD (protected)
    Route::apiResource('categories', CategoryController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy'])
        ->names([
            'index' => 'api.categories.index',
            'store' => 'api.categories.store',
            'show' => 'api.categories.show',
            'update' => 'api.categories.update',
            'destroy' => 'api.categories.destroy',
        ]);
});
