<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});


// Routes publiques
Route::resource('articles', ArticleController::class)->only(['index', 'show']);

// Routes protégées
Route::resource('articles', ArticleController::class)->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');


Route::resource('comments', CommentController::class)->middleware('auth');

Route::resource('users', UserController::class);



Route::get('/register', [UserController::class, 'index'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('auth.doLogin');
Route::delete('/login', [AuthController::class, 'logout'])->name('auth.logout');

