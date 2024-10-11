<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'getCurrentUser']);
    Route::apiResource('/schools', SchoolController::class);
    Route::apiResource('schools.departments', DepartmentController::class)->shallow();
});
