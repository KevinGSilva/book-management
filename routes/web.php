<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->get('/', function () {
    return view('web.dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('books')->namespace('Books')->name('books.')->group(function () {
    Route::get('/', [App\Http\Controllers\Web\BookController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Web\BookController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Web\BookController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [App\Http\Controllers\Web\BookController::class, 'edit'])->name('edit');
    Route::post('/update', [App\Http\Controllers\Web\BookController::class, 'update'])->name('update');
    Route::post('/destroy', [App\Http\Controllers\Web\BookController::class, 'destroy'])->name('destroy');
});
