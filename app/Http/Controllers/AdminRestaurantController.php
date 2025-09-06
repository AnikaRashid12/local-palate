<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantRequest; // ⬅️ NEW
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // ⬅️ NEW
use Illuminate\Support\Facades\File;     // ⬅️ NEW

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

        // ⬇️ NEW: also fetch incoming user requests
        $requests = RestaurantRequest::orderByDesc('created_at')->get();

        // If your admin blade is resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', compact('restaurants', 'requests'));
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

    // =========================
    // NEW: Approve / Reject user requests
    // Routes use {restaurantRequest} for implicit binding.
    // =========================

    public function approveRequest(RestaurantRequest $restaurantRequest)
    {
        $this->ensureAdmin();

        // Try to move/copy the uploaded request image into the same place
        // your normal admin-created restaurants use: storage/app/public/restaurants
        $finalImagePublicPath = null;

        if ($restaurantRequest->image_path) {
            // request image is saved under public_path(...) (e.g., public/images/requests/xxx.jpg)
            $abs = public_path($restaurantRequest->image_path);
            if (File::exists($abs)) {
                $filename = time() . '_' . basename($abs);
                // put the file into the public disk under restaurants/
                Storage::disk('public')->put('restaurants/'.$filename, File::get($abs));
                // how your app references images uploaded via the public disk:
                $finalImagePublicPath = 'storage/restaurants/'.$filename;
            }
        }

        // Create the real Restaurant entry
        Restaurant::create([
            'name'            => $restaurantRequest->name,
            'location'        => $restaurantRequest->location,
            'image'           => $finalImagePublicPath,             // can be null
            'description'     => $restaurantRequest->description,
            'food_menu'       => $restaurantRequest->food_menu,
            'service_review'  => $restaurantRequest->service_review,
            'average_rating'  => 0,                                  // starts at 0; reviews will update real avg
            // 'status'        => 'active',                           // uncomment if you have a status column
        ]);

        // Remove the request now that it's approved
        $restaurantRequest->delete();

        return back()->with('success', 'Request approved and restaurant created!');
    }

    public function rejectRequest(RestaurantRequest $restaurantRequest)
    {
        $this->ensureAdmin();

        // Simply remove the request (you could also delete the uploaded image if desired)
        $restaurantRequest->delete();

        return back()->with('success', 'Request rejected and removed.');
    }
}
