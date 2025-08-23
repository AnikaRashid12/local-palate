<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add($restaurant_id)
    {
        $user = Auth::user();

        // Prevent duplicates
        if ($user->wishlist()->where('restaurant_id', $restaurant_id)->exists()) {
            return redirect()->back()->with('info', 'Already in your wishlist!');
        }

        $user->wishlist()->attach($restaurant_id);

        return redirect()->back()->with('success', 'Restaurant added to wishlist!');
    }

    public function index()
    {
        $wishlist = Auth::user()->wishlist;
        return view('wishlist.index', compact('wishlist'));
    }

    public function remove($restaurant_id)
    {
        Auth::user()->wishlist()->detach($restaurant_id);
        return redirect()->back()->with('warning', 'Removed from wishlist!');
    }
}
