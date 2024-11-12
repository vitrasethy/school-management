<?php

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\GroupCodeController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'getCurrentUser']);
    Route::apiResource('/schools', SchoolController::class);
    Route::apiResource('schools.departments', DepartmentController::class)->shallow();

    Route::post('{group}/join-group', [GroupCodeController::class, 'join']);

    Route::get('groups/user', [GroupController::class, 'findByUser']);

    Route::apiResource('groups', GroupController::class);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
});

Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('register', [RegisteredUserController::class, 'store']);
