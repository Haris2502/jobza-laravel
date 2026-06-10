<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReelsController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Tanpa Login / Bebas Diakses Flutter Web & Mobile)
|--------------------------------------------------------------------------
*/

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// JOBS
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{id}', [JobController::class, 'show']);

// REELS PUBLIC (Melihat daftar reels bebas tanpa login)
Route::get('/reels', [ReelsController::class, 'index']);

// RESUME, AVATAR & COMPANY LOGO (Download file via Laravel, bukan storage symlink)
Route::get('/resume/{userId}', [ProfileController::class, 'downloadResume']);
Route::get('/avatar/{userId}', [ProfileController::class, 'downloadAvatar']);
Route::get('/company-logo/{adminId}', [ProfileController::class, 'downloadCompanyLogo']);


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Wajib Login - Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /* REELS INTERACTION */
    Route::post('/reels/{id}/like', [ReelsController::class, 'toggleLike']);
    Route::post('/reels/{id}/save', [ReelsController::class, 'toggleSave']);

    /* PROFILE */
    Route::post('/profiles', [ProfileController::class, 'store']);
    Route::get('/profiles/{id}', [ProfileController::class, 'show']);
    Route::put('/profiles/{id}', [ProfileController::class, 'update']);
    Route::delete('/profiles/{id}', [ProfileController::class, 'destroy']);
    Route::get('/profiles', [ProfileController::class, 'index']);

    /* KHUSUS ADMIN (WEBSITE) */
    Route::middleware('role:admin')->group(function () {
        Route::post('/jobs', [JobController::class, 'store']);
        Route::put('/jobs/{id}', [JobController::class, 'update']);
        Route::delete('/jobs/{id}', [JobController::class, 'destroy']);

        Route::post('/reels', [ReelsController::class, 'store']);
        Route::put('/reels/{id}', [ReelsController::class, 'update']);
        Route::delete('/reels/{id}', [ReelsController::class, 'destroy']);

        Route::get('/admin/applications', [ApplicationController::class, 'allApplications']);
    });

    /* KHUSUS USER (MOBILE APP) */
    Route::middleware('role:user')->group(function () {
        Route::post('/apply', [ApplicationController::class, 'apply']);
        Route::get('/my-applications', [ApplicationController::class, 'userApplications']);

        Route::get('/my-saved-reels', [ReelsController::class, 'getSavedReels']);
    });
});
