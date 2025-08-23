<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class UserDashboardController extends Controller
{
    /**
     * Show the user dashboard with wishlist, reviews, and top-rated restaurants.
     */
    public function index()
    {
        $user = Auth::user();

        // Get the user's wishlist
        $wishlist = $user->wishlist()->get();

        // Get the user's reviews with restaurant info
        $reviews = $user->reviews()->with('restaurant')->latest()->get();

        // Get top-rated restaurants (by average rating)
        $topRestaurants = Restaurant::with('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(5)
            ->get();

        return view('user-dashboard.index', compact('wishlist', 'reviews', 'topRestaurants'));
    }
}
