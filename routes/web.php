<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Mail\NewPublicationNotification;
use App\Models\Publication;
use Illuminate\Support\Facades\Mail;

Route::middleware("guest")->group(function () {
    Route::get('/register', [UserController::class, 'index'])->name('register');
    Route::post('/register',[UserController::class,'store'])->name('users.register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('auth.doLogin');
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('forgot_password.form');
    Route::post('/forgot-password', [AuthController::class, 'sendnewPassword'])->name('forgot_password');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('reset_password.form');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset_password');
    
});

Route::get('/{slug?}', [PublicationController::class, 'index'])->name('publications.index');


Route::middleware("auth")->group(function () {
    Route::resource('publications', PublicationController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('comments', CommentController::class);
    Route::resource('users', UserController::class);
    Route::delete('/login', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/',[FavoriController::class,'toggleFavorite'])->name('favoris');
    Route::get('/publications/favoris',[FavoriController::class,'favoris'])->name('publications.favoris');
    Route::post('/ratings', [RatingController::class, 'ratings'])->name('ratings');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');
    Route::get('/publications/en_attentes', [PublicationController::class, 'enAttente'])->name('publications.en_attente');
    Route::post('/publications/{slug}/validate', [PublicationController::class, 'validatePublication'])->name('publications.validate');
    Route::post('/user/subscribe', [UserController::class, 'subscribe'])->name('user.subscribe');
    Route::get('/mes_publications', [PublicationController::class, 'mes_Publication'])->name('mes_publications');
    Route::get('/categories',[PublicationController::class,'categories'])->name('categories');
    Route::post('categories',[PublicationController::class,'storeCategorie'])->name('categories.store');
    Route::delete('categories/{categorie}',[PublicationController::class,'destroyCategorie'])->name('category.destroy');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.update');
    Route::get('/publications/{name}',[PublicationController::class,'authorPub'])->name('author.publication');
    
});

Route::get('categoris/{slug}',[PublicationController::class,'index'])->name('publications.categorie');
Route::get('/publications/{slug}', [PublicationController::class, 'show'])->name('publications.show');



