<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=> 'post'],function(){
Route::get('/create',[PostController::class,'create'])->name('post.create');
Route::get('/index',[PostController::class,'index'])->name('post.index');
Route::post('/store',[PostController::class,'store'])->name('post.store');
Route::get('/edit/{id}',[PostController::class,'edit'])->name('post.edit');
Route::post('/update/{id}',[PostController::class,'update'])->name('post.update');
Route::post('/destroy/{id}',[PostController::class,'destroy'])->name('post.destroy');
Route::get('/show/{id}',[PostController::class,'show'])->name('post.show');
Route::post('/{id}/favorite',[FavoriteController::class,'store'])->name('favorites.favorite');
Route::delete('/{id}/unfavorite',[FavoriteController::class,'destroy'])->name('favorites.unfavorite');
});

Route::get('/user/{id}',[UserController::class,'show'])->name('user.show');
Route::post('/posts/{post}/comments',[CommentController::class,'store'])->name('comments.store');
Route::delete('/comments/{comment}/destroy',[CommentController::class,'destroy'])->name('comments.destroy');
Route::post('user/{user}/follow',[UserController::class,'follow'])->name('follow');
Route::delete('user/{user}/unfollow',[UserController::class,'unfollow'])->name('unfollow');
