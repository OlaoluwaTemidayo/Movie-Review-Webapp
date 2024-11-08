<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirect root to movies index
Route::redirect('/', '/movies');

// Resource routes for movies (index, show,)
Route::resource('movies', MovieController::class);


// Comment routes for storing comments
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// Authentication routes (login, register, etc.)
Auth::routes();

// Protected routes for adding movies
Route::middleware('auth')->group(function () {
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    
    // Show route using slug instead of id
    Route::get('/movies/{slug}', [MovieController::class, 'show'])->name('movies.show');
    Route::get('/movies/{slug}/edit', [MovieController::class, 'edit'])->name('movies.edit');
});

// Home route (if you have a home dashboard)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
