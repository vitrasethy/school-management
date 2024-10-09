<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();
