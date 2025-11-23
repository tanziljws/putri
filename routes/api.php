<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\GalleryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API routes commented out - API controller not implemented yet
// Uncomment when App\Http\Controllers\Api\GalleryController is created

// // Public Gallery APIs (no auth required)
// Route::prefix('public')->name('api.public.')->group(function () {
//     Route::apiResource('galleries', GalleryController::class)
//         ->only(['index', 'show']);
// });

// // Protected Gallery APIs (auth:sanctum required)
// Route::middleware('auth:sanctum')->name('api.')->group(function () {
//     Route::apiResource('galleries', GalleryController::class)
//         ->except(['index', 'show']);
// });
