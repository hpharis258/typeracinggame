<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/auth', function () {
    return view('auth');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/posts', function () {
    return view('posts');
});
Route::get('/scores', function () {
    return view('scores');
});
