<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Pages\Department\DepartmentCreate;
use App\Livewire\Pages\Department\DepartmentIndex;
use App\Livewire\Pages\Department\DepartmentEdit;
use App\Livewire\Pages\Department\DepartmentShow;
use App\Livewire\Pages\Group\GroupCreate;
use App\Livewire\Pages\Group\GroupEdit;
use App\Livewire\Pages\Group\GroupIndex;
use App\Livewire\Pages\Group\GroupShow;
use App\Livewire\Pages\School\SchoolCreate;
use App\Livewire\Pages\School\SchoolIndex;
use App\Livewire\Pages\School\SchoolShow;
use App\Livewire\Pages\School\SchoolUpdate;
use App\Livewire\Pages\User\UserCreate;
use App\Livewire\Pages\User\UserEdit;
use App\Livewire\Pages\User\UserShow;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
// School
Route::get('/school', SchoolShow::class)->middleware('auth')->name('super.school.show');
Route::get('/school/create', SchoolCreate::class)->middleware('auth')->name('super.school.create');
Route::get('/school/{school}', SchoolIndex::class)->middleware('auth')->name('super.school.index');
Route::get('/school/{school}/edit', SchoolUpdate::class)->middleware('auth')->name('school.edit');
// Department
Route::get('/department', DepartmentShow::class)->middleware('auth')->name('department.show');
Route::get('/department/create', DepartmentCreate::class)->middleware('auth')->name('department.create');
Route::get('/department/{department}', DepartmentIndex::class)->middleware('auth')->name('department.index');
Route::get('/department/{department}/edit', DepartmentEdit::class)->middleware('auth')->name('department.edit');
// Group
Route::get('/group', GroupShow::class)->middleware('auth')->name('group.show');
Route::get('/group/create', GroupCreate::class)->middleware('auth')->name('group.create');
Route::get('/group/{group}', GroupIndex::class)->middleware('auth')->name('group.index');
Route::get('/group/{group}/edit', GroupEdit::class)->middleware('auth')->name('group.edit');
// Student
Route::get('/user', UserShow::class)->middleware('auth')->name('user.show');
Route::get('/user/create', UserCreate::class)->middleware('auth')->name('user.create');
Route::get('/user/{user}/edit', UserEdit::class)->middleware('auth')->name('user.edit');

Auth::routes();
