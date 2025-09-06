<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController; // ← missing semicolon fixed
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserDashboardController;

// ⬇️ NEW: add these two controllers
use App\Http\Controllers\MyDashboardController;
use App\Http\Controllers\AdminRestaurantController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    //'verified',
])->group(function () {
    // Dashboard (homepage after login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User dashboard
    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // ⬇️ NEW: Smart redirect—admins → /admin, users → /user-dashboard
    Route::get('/my-dashboard', MyDashboardController::class)->name('my.dashboard');

    // Restaurant detail + reviews
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
    Route::post('/restaurants/{restaurant}/reviews', [RestaurantController::class, 'storeReview'])->name('restaurants.reviews.store');

    // ⭐ Wishlist routes (only logged-in users)
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{restaurant}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{restaurant}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // ⬇️ NEW: Admin routes (controller self-guards role=admin)
    Route::get('/admin', [AdminRestaurantController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/restaurants', [AdminRestaurantController::class, 'store'])->name('admin.restaurants.store');
    Route::patch('/admin/restaurants/{restaurant}/status', [AdminRestaurantController::class, 'toggleStatus'])->name('admin.restaurants.toggleStatus');
});
