<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
// School
Route::get('/school', [SchoolController::class, 'show'])->middleware('auth')->name('super.school.show');
// Department
Route::get('/department', [DepartmentController::class, 'show'])->middleware('auth')->name('department.show');
// Group
Route::get('/group', [GroupController::class, 'show'])->middleware('auth')->name('group.show');
// Student
Route::get('/user', [UserController::class, 'show'])->middleware('auth')->name('user.show');
// Subject
Route::get('/subject', [SubjectController::class, 'show'])->middleware('auth')->name('subject.show');

Auth::routes();
