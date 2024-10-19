<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\School\SchoolCreate;
use App\Livewire\School\SchoolIndex;
use App\Livewire\School\SchoolList;
use App\Livewire\School\SchoolUpdate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get("/profile", [ProfileController::class, 'index'])->middleware('auth')->name('profile');
// School
Route::get('/school', SchoolList::class)->middleware('auth')->name('school');
Route::get('/school/create', SchoolCreate::class)->middleware('auth')->name('school.create');
Route::get('/school/{school}', SchoolIndex::class)->middleware('auth')->name('school.index');
Route::get('/school/{school}/edit', SchoolUpdate::class)->middleware('auth')->name('school.edit');

Auth::routes();
