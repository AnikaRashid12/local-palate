<?php

namespace App\Http\Controllers;

use App\Models\Restaurant; 
use App\Models\Review; 
use Illuminate\Http\Request; 

class RestaurantController extends Controller
{
    /* *
     * @param  \App\Models\Restaurant  $restaurant (Laravel's Route Model Binding)
     * @return \Illuminate\View\View
     */
    public function show(Restaurant $restaurant)
    {
        $reviews = $restaurant->reviews()->latest()->get(); 

        return view('restaurants.show', compact('restaurant', 'reviews'));
    }

    /**
     * Store a new review for a specific restaurant.
     * This method will handle the form submission from the individual restaurant page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeReview(Request $request, Restaurant $restaurant)
    {
        //dd('Store review method hit!', $request->all());
        $request->validate([
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $review = new Review();
        $review->user_id = auth()->id(); // logged-in user
        $review->restaurant_id = $restaurant->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return back()->with('success', 'Your review has been submitted!');
    }

    /**
     * Create/store a restaurant (adds support for `description`)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => ['required','string','max:255'],
            'location'       => ['nullable','string','max:255'],
            'image'          => ['nullable','string','max:255'],
            'food_menu'      => ['nullable','string'],
            'service_review' => ['nullable','string'],
            'average_rating' => ['nullable','numeric','between:0,5'],
            'description'    => ['nullable','string','max:255'], // ← new short blurb
        ]);

        Restaurant::create($validated);

        // Use your preferred redirect (index/show). Back is safest if routes vary.
        return back()->with('success', 'Restaurant created.');
    }

    /**
     * Update an existing restaurant (supports `description`)
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \App\Models\Restaurant     $restaurant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name'           => ['required','string','max:255'],
            'location'       => ['nullable','string','max:255'],
            'image'          => ['nullable','string','max:255'],
            'food_menu'      => ['nullable','string'],
            'service_review' => ['nullable','string'],
            'average_rating' => ['nullable','numeric','between:0,5'],
            'description'    => ['nullable','string','max:255'], // ← new short blurb
        ]);

        $restaurant->update($validated);

        return back()->with('success', 'Restaurant updated.');
    }
}
