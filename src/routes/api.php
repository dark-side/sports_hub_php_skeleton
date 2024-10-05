<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;

// Articles ------------

// protected routes
Route::middleware('auth:api')->prefix('articles')->group(function () {
    Route::post('/', [ArticleController::class, 'store'])->name('article.store');
    //Route::put('/{article}', [ArticleController::class, 'update'])->name('article.update');
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

// User ------------

// protected routes
Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::get('/refresh', [AuthController::class, 'refresh'])->name('user.refresh');
    Route::get('/', [AuthController::class, 'profile'])->name('user.profile');
    Route::put('/', [AuthController::class, 'update'])->name('user.update');
    Route::delete('/', [AuthController::class, 'destroy'])->name('user.delete');
});

Route::group(
    [
        'prefix' => 'user'
    ],
    function () {
        Route::post('/', [AuthController::class, 'signup'])->name('user.create');
        Route::post('/login', [AuthController::class, 'login'])->name('user.login');
    }
);
