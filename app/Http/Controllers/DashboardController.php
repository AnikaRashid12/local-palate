<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with restaurants, optionally filtered by search + filters (no rating).
     */
    public function index(Request $request)
    {
        // Keep your original param name; also accept 'q' if sent from another form
        $search   = $request->query('search', $request->query('q', ''));
        $location = trim($request->query('location', ''));     // partial match
        $cuisine  = trim($request->query('cuisine', ''));      // can be "Sushi, Pizza"
        $sort     = $request->query('sort', 'rating_desc');    // rating_desc|rating_asc|name_asc|name_desc

        $query = Restaurant::query();

        // ➕ Add review aggregates for the Trending badge and stars
        $query->withAvg('reviews', 'rating')   // gives: reviews_avg_rating
              ->withCount('reviews');          // gives: reviews_count

        // --- Search (grouped safely so later filters still apply) ---
        if ($search && strlen($search) >= 3) {
            $s = "%{$search}%";
            $query->where(function ($qr) use ($s) {
                $qr->where('name', 'like', $s)
                   ->orWhere('food_menu', 'like', $s)
                   ->orWhere('location', 'like', $s)
                   ->orWhere('description', 'like', $s);
            });
        }

        // --- Filters (no rating) ---
        if ($location !== '') {
            // forgiving partial match
            $query->where('location', 'like', "%{$location}%");
        }

        if ($cuisine !== '') {
            // allow comma/space separated tokens: "Sushi, Pizza"
            $tokens = collect(preg_split('/[,\s]+/', $cuisine, -1, PREG_SPLIT_NO_EMPTY))
                        ->map(fn ($t) => trim($t))
                        ->filter();

            if ($tokens->isNotEmpty()) {
                $query->where(function ($qr) use ($tokens) {
                    foreach ($tokens as $t) {
                        $qr->orWhere('food_menu', 'like', "%{$t}%");
                    }
                });
            }
        }

        // --- Sort (kept exactly as you had it) ---
        switch ($sort) {
            case 'rating_asc':
                $query->orderBy('average_rating', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default: // 'rating_desc'
                $query->orderBy('average_rating', 'desc');
        }

        // No pagination (kept)
        $restaurants = $query->get();

        // Distinct locations for the dropdown
        $locations = Restaurant::query()
            ->select('location')
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('dashboard', [
            'restaurants' => $restaurants,
            'search'      => $search,
            'locations'   => $locations,
            'location'    => $location,
            'cuisine'     => $cuisine,
            'sort'        => $sort,
        ]);
    }
}
