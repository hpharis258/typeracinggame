<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ScoresController;
use App\Http\Controllers\MemesController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home/gameOverNotLoggedIn', [Scores::class, 'GameOverNotLoggedIn'])->name('home.gameOverNotLoggedIn');

Route::get('/about', function () {
    return view('about');
});
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/memes', [MemesController::class, 'index'])->name('memes.index');
Route::get('/scores', [ScoresController::class, 'index'])->name('scores.index');


Route::get('/welcome', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('/');

Route::middleware('auth')->group(function () {
    //Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/memes/create', [MemesController::class, 'create'])->name('memes.create');
    Route::post('/memes', [MemesController::class, 'store'])->name('memes.store');
    Route::put('/memes/{meme}/updateUpvote', [MemesController::class, 'updateUpvote'])->name('memes.updateUpvote');
    Route::put('/memes/{meme}/updateDownvote', [MemesController::class, 'updateDownvote'])->name('memes.updateDownvote');
    //Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/scores', [ScoresController::class, 'store'])->name('scores.store');
    //Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    //Route::put('/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');
  //  Route::put('/posts/{post}/updateUpvote', [PostController::class, 'updateUpvote'])->name('posts.updateUpvote');
    //Route::put('/posts/{post}/updateDownvote', [PostController::class, 'updateDownvote'])->name('posts.updateDownvote');
    //Route::delete('/posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
