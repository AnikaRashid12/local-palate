<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class AdminRestaurantController extends Controller
{
    /**
     * Simple guard to allow only admins.
     */
    protected function ensureAdmin(): void
    {
        $user = auth()->user();
        if (!$user || strcasecmp($user->role ?? '', 'admin') !== 0) {
            abort(403, 'Admins only.');
        }
    }

    public function index()
    {
        $this->ensureAdmin();

        // Show list with avg rating + review count
        $restaurants = Restaurant::query()
            ->withAvg('reviews', 'rating')   // ->reviews_avg_rating
            ->withCount('reviews')           // ->reviews_count
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'location'       => ['required', 'string', 'max:255'],
            'food_menu'      => ['nullable', 'string', 'max:1000'],
            'service_review' => ['nullable', 'string', 'max:1000'],
            'description'    => ['nullable', 'string', 'max:5000'],
            'status'         => ['required', 'in:active,inactive'],
            'image'          => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        // Store image in public disk (one-time: php artisan storage:link)
        $path = $request->file('image')->store('restaurants', 'public'); // storage/app/public/restaurants/...
        $validated['image'] = 'storage/' . $path;

        // Initial average; real average comes from reviews
        $validated['average_rating'] = 0;

        Restaurant::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Restaurant added!');
    }

    public function toggleStatus(Restaurant $restaurant)
    {
        $this->ensureAdmin();

        // Requires a 'status' column on restaurants table
        $restaurant->status = ($restaurant->status === 'active') ? 'inactive' : 'active';
        $restaurant->save();

        return back()->with('success', 'Status updated.');
    }
}
