<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant; // IMPORTANT: Make sure this path is correct for your Restaurant model

class DashboardController extends Controller
{
    /**
     * Display the dashboard with restaurants, optionally filtered by search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get the search term from the request
        $search = $request->query('search');

        // Start a new query on the Restaurant model
        $query = Restaurant::query();

        // Check if a search term exists and has at least 3 characters
        if ($search && strlen($search) >= 3) {
            // Apply search filters to name, food_menu, and location
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('food_menu', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
        }

        // Get the results
        $restaurants = $query->get();

        // Pass the restaurants and the search term to the view
        return view('dashboard', [
            'restaurants' => $restaurants,
            'search' => $search, // Pass the search term back to the view to pre-fill the input
        ]);
    }
}