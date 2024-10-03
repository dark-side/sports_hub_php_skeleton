<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\JwtAuthController;
use App\Http\Middleware\JwtMiddleware;


/*
const ARTICLE_PREFIX = '/articles';

Route::get(ARTICLE_PREFIX, [ArticleController::class, 'index'])->name('article.index');
Route::get(ARTICLE_PREFIX . '/{id}', [ArticleController::class, 'get'])->name('article.show');
Route::post(ARTICLE_PREFIX, [ArticleController::class, 'create'])->name('article.create');
Route::get(ARTICLE_PREFIX . '/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
Route::put(ARTICLE_PREFIX . '/{id}', [ArticleController::class, 'update'])->name('article.update');
Route::delete(ARTICLE_PREFIX . '/{id}', [ArticleController::class, 'delete'])->name('article.delete');
*/

Route::resource('articles', ArticleController::class);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user/logout', [JwtAuthController::class, 'logout']);
});

Route::post('user/signup', [JwtAuthController::class, 'signup']);
Route::post('user/login', [JwtAuthController::class, 'login']);
