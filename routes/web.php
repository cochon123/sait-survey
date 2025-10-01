<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropositionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('propositions.index');
    }
    return view('welcome');
})->name('home');

Route::get('/join', [App\Http\Controllers\JoinController::class, 'index'])->name('join');
Route::post('/join', [App\Http\Controllers\JoinController::class, 'submit'])->name('join.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/propositions', [PropositionController::class, 'index'])->name('propositions.index');
Route::post('/propositions', [PropositionController::class, 'store'])->middleware('auth')->name('propositions.store');
Route::post('/propositions/{proposition}/upvote', [PropositionController::class, 'upvote'])->middleware('auth')->name('propositions.upvote');
Route::post('/propositions/{proposition}/downvote', [PropositionController::class, 'downvote'])->middleware('auth')->name('propositions.downvote');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour l'authentification Google
Route::get('/auth/google/redirect', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__.'/auth.php';
