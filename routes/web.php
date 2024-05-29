<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/post',function () {
    return view('post');
});

Route::get('/comment',function () {
    return view('comment');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class)->except('index','create','store');
Route::resource('post', PostController::class);
Route::resource('comment', CommentController::class);