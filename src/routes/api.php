<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;

/*
Route::group(
    [
        'prefix' => 'articles'
    ],
    function () {
        Route::get('/', [ArticleController::class, 'index'])->name('article.index');
        Route::get('/{id}', [ArticleController::class, 'get'])->name('article.show');
        Route::post('/', [ArticleController::class, 'create'])->name('article.create');
        Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
        Route::put('/{id}', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('/{id}', [ArticleController::class, 'delete'])->name('article.delete');
    }
);
*/
// use resource() instead of the above
Route::resource('articles', ArticleController::class);

Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');;
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
