<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

// Autenticación pública
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Lectura pública
Route::apiResource('products',   ProductController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('brands',     BrandController::class)->only(['index', 'show']);
Route::apiResource('suppliers',  SupplierController::class)->only(['index', 'show']);
Route::apiResource('reviews',    ReviewController::class)->only(['index', 'show']);

// Rutas que requieren estar autenticado
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Cualquier usuario autenticado puede gestionar reseñas
    Route::apiResource('reviews', ReviewController::class)->except(['index', 'show']);

    // Solo admin
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('products',   ProductController::class)->except(['index', 'show']);
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
        Route::apiResource('brands',     BrandController::class)->except(['index', 'show']);
        Route::apiResource('suppliers',  SupplierController::class)->except(['index', 'show']);
        Route::apiResource('roles',      RoleController::class);
        Route::apiResource('users',      UserController::class);
    });
});
