<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=> 'post'],function(){
Route::get('/create',[PostController::class,'create'])->name('post.create');
});
Route::post('/store',[PostController::class,'store'])->name('post.store');