<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LoansController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk autentikasi
Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


Route::post('book/loan', [LoansController::class, 'loan'])->middleware('auth:sanctum');
Route::post('book/return', [LoansController::class, 'returnBook'])->middleware('auth:sanctum');

// Route resource untuk book, author, dan category
Route::resource('book', BookController::class);
Route::resource('author', AuthorController::class);
Route::resource('category', CategoriesController::class);
