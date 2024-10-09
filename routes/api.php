<?php

use App\Http\Controllers\Auth\Api\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Api\RegisteredUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'getCurrentUser'])
    ->middleware('auth:sanctum');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::apiResource('/schools', SchoolController::class)->middleware('auth:sanctum');
Route::apiResource('schools.departments', DepartmentController::class)
    ->shallow()
    ->middleware('auth:sanctum');
