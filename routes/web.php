<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; // ADD THIS LINE to import your new controller
// REMOVE: use App\Models\Restaurant; // This use statement is no longer needed here, it's in the controller now
use App\Http\Controllers\RestaurantController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // CHANGE THIS LINE to point to your new DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');

    Route::post('/restaurants/{restaurant}/reviews', [RestaurantController::class, 'storeReview'])->name('restaurants.reviews.store');
});