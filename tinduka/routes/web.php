<?php

use App\Http\Controllers\LocationController;  // ← ADD THIS LINE
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
});

require __DIR__.'/auth.php';