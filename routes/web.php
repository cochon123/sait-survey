<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropositionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ModerationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('propositions.index');
    }
    return view('welcome');
})->name('root');

// Route pour la landing page accessible à tous
Route::get('/welcome', function () {
    return view('welcome');
})->name('home');

Route::get('/join', [App\Http\Controllers\JoinController::class, 'index'])->name('join');
Route::post('/join', [App\Http\Controllers\JoinController::class, 'submit'])->name('join.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/propositions', [PropositionController::class, 'index'])->name('propositions.index');
Route::get('/propositions/load-more', [PropositionController::class, 'loadMore'])->name('propositions.load-more');
Route::post('/propositions', [PropositionController::class, 'store'])->middleware(['auth', 'profile.completed'])->name('propositions.store');
Route::post('/propositions/{proposition}/upvote', [PropositionController::class, 'upvote'])->middleware(['auth', 'profile.completed'])->name('propositions.upvote');
Route::post('/propositions/{proposition}/downvote', [PropositionController::class, 'downvote'])->middleware(['auth', 'profile.completed'])->name('propositions.downvote');
Route::delete('/propositions/{proposition}', [PropositionController::class, 'destroy'])->middleware(['auth', 'profile.completed'])->name('propositions.destroy');

// Routes pour les commentaires
Route::post('/propositions/{proposition}/comments', [CommentController::class, 'store'])->middleware(['auth', 'profile.completed'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware(['auth', 'profile.completed'])->name('comments.destroy');

// Routes pour la modération de contenu
Route::middleware(['auth'])->prefix('moderation')->group(function () {
    Route::post('/nickname', [ModerationController::class, 'checkNickname'])->name('moderation.nickname');
    Route::post('/proposition', [ModerationController::class, 'checkProposition'])->name('moderation.proposition');
    Route::post('/comment', [ModerationController::class, 'checkComment'])->name('moderation.comment');
});

// Page de test de modération (environnement de développement uniquement)
if (app()->environment('local')) {
    Route::get('/moderation-test', function () {
        return view('moderation-test');
    })->name('moderation.test');
}

Route::middleware(['auth', 'profile.completed'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour l'authentification Google
Route::get('/auth/google/redirect', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Routes pour la complétion du profil
// Routes pour la complétion du profil
Route::middleware('auth')->group(function () {
    Route::get('/profile/complete', [App\Http\Controllers\ProfileCompletionController::class, 'create'])->name('profile.complete');
    Route::post('/profile/complete', [App\Http\Controllers\ProfileCompletionController::class, 'store'])->name('profile.complete.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/complete', [App\Http\Controllers\Auth\ProfileSetupController::class, 'show'])->name('profile.complete');
    Route::post('/profile/complete', [App\Http\Controllers\Auth\ProfileSetupController::class, 'store'])->name('profile.complete.store');
});

require __DIR__.'/auth.php';
