<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Middleware\AdminMiddlewareApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', AdminMiddlewareApi::class])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/check-token', function () {
        return response()->json(true);
    });

    Route::apiResource('authors', AuthorController::class);
    Route::get('authors/{id}/books', [AuthorController::class, 'books']);

    Route::apiResource('books', BookController::class);
});