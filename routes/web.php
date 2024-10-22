<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\Department\DepartmentCreate;
use App\Livewire\Pages\Department\DepartmentIndex;
use App\Livewire\Pages\Department\DepartmentEdit;
use App\Livewire\Pages\Department\DepartmentShow;
use App\Livewire\Pages\Group\GroupEdit;
use App\Livewire\Pages\Group\GroupIndex;
use App\Livewire\Pages\Student\StudentEdit;
use App\Livewire\Pages\Student\StudentIndex;
use App\Livewire\Pages\School\SchoolCreate;
use App\Livewire\Pages\School\SchoolIndex;
use App\Livewire\Pages\School\SchoolList;
use App\Livewire\Pages\School\SchoolUpdate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
// School
Route::get('/school', SchoolList::class)->middleware('auth')->name('school');
Route::get('/school/create', SchoolCreate::class)->middleware('auth')->name('school.create');
Route::get('/school/{school}', SchoolIndex::class)->middleware('auth')->name('school.index');
Route::get('/school/{school}/edit', SchoolUpdate::class)->middleware('auth')->name('school.edit');
// Department
Route::get('/department', DepartmentShow::class)->middleware('auth')->name('department');
Route::get('/department/create', DepartmentCreate::class)->middleware('auth')->name('department.create');
Route::get('/department/{department}', DepartmentIndex::class)->middleware('auth')->name('department.index');
Route::get('/department/{department}/edit', DepartmentEdit::class)->middleware('auth')->name('department.edit');
// Group
Route::get('/group/{group}', GroupIndex::class)->middleware('auth')->name('group.index');
Route::get('/group/{group}/edit', GroupEdit::class)->middleware('auth')->name('group.edit');
// Student
Route::get('/student/{user}', StudentIndex::class)->middleware('auth')->name('student.index');
Route::get('/student/{user}/edit', StudentEdit::class)->middleware('auth')->name('student.edit');

Auth::routes();
