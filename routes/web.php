<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SubjectController;
use App\Livewire\Group\GroupShow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
// School
Route::get('/school', [SchoolController::class, 'show'])->middleware('auth')->name('super.school.show');
// Department
Route::get('/department', [DepartmentController::class, 'show'])->middleware('auth')->name('department.show');
// Group
Route::view('/group', 'group.group-index')->middleware('auth')->name('group.index');
Route::get('/group/{group}', GroupShow::class)->middleware('auth')->name('group.show');
// Subject
Route::get('/subject', [SubjectController::class, 'show'])->middleware('auth')->name('subject.show');

Route::view('/user/student', 'user.student-index')->middleware('auth')->name('student.index');
Route::view('/user/teacher', 'user.teacher-index')->middleware('auth')->name('teacher.index');
Route::view('/user', 'user.staff-index')->middleware('auth')->name('staff.index');

Auth::routes();
