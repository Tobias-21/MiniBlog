<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Models\Article;

Route::middleware("guest")->group(function () {
    Route::get('/register', [UserController::class, 'index'])->name('register');
    Route::post('/register',[UserController::class,'store'])->name('users.register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('auth.doLogin');
    
});

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');


Route::middleware("auth")->group(function () {
    Route::resource('articles', ArticleController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('comments', CommentController::class);
    Route::resource('users', UserController::class);
    Route::delete('/login', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/',[FavoriController::class,'toggleFavorite'])->name('favoris');
    Route::get('/articles/favoris',[FavoriController::class,'favoris'])->name('articles.favoris');
    Route::post('/ratings', [RatingController::class, 'ratings'])->name('ratings');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');

});

Route::get('categorie/{slug}/articles',[ArticleController::class,'index'])->name('articles.categorie');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');


/*Route::get('/', function () {
    return view('welcome');
});*/
