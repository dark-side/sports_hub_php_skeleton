<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

// Articles ------------

// protected routes
Route::middleware('auth:api')->prefix('articles')->group(function () {
    Route::post('/', [ArticleController::class, 'store'])->name('article.store');
    Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('article.delete');
});

Route::group(
    [
        'prefix' => 'articles'
    ],
    function () {
        Route::get('/', [ArticleController::class, 'index'])->name('article.index');
        Route::get('/{article}', [ArticleController::class, 'get'])->name('article.get');
        Route::put('/{article}', [ArticleController::class, 'update'])->name('article.update');
    }
);

// Auth ------------

// Registration WITHOUT /api prefix (as per official spec)
Route::post('/users/registrations', [AuthController::class, 'signup'])->name('user.create');

// Auth routes WITH /api prefix
Route::prefix('auth')->group(function () {
    Route::post('/sign_in', [AuthController::class, 'login'])->name('auth.sign_in');
    
    // Protected routes
    Route::middleware('auth:api')->group(function () {
        Route::delete('/sign_out', [AuthController::class, 'logout'])->name('auth.sign_out');
    });
});

// User management routes WITH /api prefix
Route::prefix('users')->group(function () {
    // Public routes
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    
    // Protected routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
        Route::put('/profile', [AuthController::class, 'update'])->name('user.update');
        Route::delete('/profile', [AuthController::class, 'destroy'])->name('user.delete');
        Route::get('/refresh', [AuthController::class, 'refresh'])->name('user.refresh');
    });
});
