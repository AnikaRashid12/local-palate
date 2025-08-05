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
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        //  Create a new review
        // IMPORTANT: This assumes you have a 'Review' model and 'reviews' table
        // and that the 'reviews' table has 'user_id', 'restaurant_id', 'rating', 'comment' columns.
        $review = new Review();
        $review->user_id = auth()->id(); // Get the ID of the currently logged-in user
        $review->restaurant_id = $restaurant->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        //  Redirect back to the restaurant page with a success message
        return back()->with('success', 'Your review has been submitted!');
    }
}