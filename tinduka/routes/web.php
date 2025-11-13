<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// PUBLIC
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/locations/{location}', [LocationController::class, 'show'])
    ->name('locations.show');

// AUTH
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // My Reviews
    Route::get('/profile/reviews', function () {
        return view('profile.reviews');
    })->name('profile.reviews');

    // Review CRUD
    Route::post('/locations/{location}/review', [LocationController::class, 'storeReview'])
        ->name('locations.review');

    Route::put('/locations/{location}/reviews/{review}', [LocationController::class, 'updateReview'])
        ->name('reviews.update');

    Route::delete('/locations/{location}/reviews/{review}', [LocationController::class, 'deleteReview'])
        ->name('reviews.delete');

    // Comment
    Route::post('/reviews/{review}/comment', [LocationController::class, 'storeComment'])
        ->name('reviews.comment');
});

require __DIR__.'/auth.php';