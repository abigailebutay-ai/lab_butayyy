<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;

// ------------------
// PUBLIC ROUTES
// ------------------
Route::get('/', function () {
    return view('welcome');
});

// USER PROFILE (public or logged-in, your choice)
Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show');

// ------------------
// AUTHENTICATED ROUTES
// ------------------
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Tweets
    Route::get('/tweets', [TweetController::class, 'index'])->name('tweets.index');
    Route::get('/tweets/create', [TweetController::class, 'create'])->name('tweets.create');
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->name('tweets.edit');
    Route::patch('/tweets/{tweet}', [TweetController::class, 'update'])->name('tweets.update');
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy');

    // Likes
    Route::post('/tweets/{tweet}/like', [LikeController::class, 'toggle'])
        ->name('tweets.like');

    // Profile settings (for the logged-in user)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
