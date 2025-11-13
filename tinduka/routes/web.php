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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/locations/{location}/review', [LocationController::class, 'storeReview'])
        ->name('locations.review');

    Route::post('/reviews/{review}/comment', [LocationController::class, 'storeComment'])
        ->name('reviews.comment');
});

require __DIR__.'/auth.php';