<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController; // ← missing semicolon fixed
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard (homepage after login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // user dashboard
     Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    // Restaurant detail + reviews
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
    Route::post('/restaurants/{restaurant}/reviews', [RestaurantController::class, 'storeReview'])->name('restaurants.reviews.store');

    // ⭐ Wishlist routes (add these inside the group so only logged-in users can use them)
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{restaurant}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{restaurant}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});
