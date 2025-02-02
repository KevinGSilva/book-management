<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->get('/', function () {
    return view('web.dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
