<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/users/registrations', [AuthController::class, 'signup'])->name('user.create');
