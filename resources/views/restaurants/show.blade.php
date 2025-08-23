<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $restaurant->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-100 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Restaurant Image (Centered) -->
                <div class="flex justify-center items-center mb-6">
                    <img src="{{ asset($restaurant->image) }}"
                        alt="{{ $restaurant->name }}"
                        class="w-full max-w-lg h-64 object-cover object-center rounded-lg shadow-md">
                </div>

                <!-- Restaurant Name (Large Bold) -->
                <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-4">
                    {{ $restaurant->name }}
                </h1>

                <!-- Rating (Placeholder for now) -->
                <div class="text-center text-yellow-500 text-xl mb-6">
                    {{-- calculate average rating here from reviews later --}}
                    @php
                        // Calculate average rating if reviews exist
                        $averageRating = $reviews->avg('rating');
                        $starCount = round($averageRating);
                    @endphp

                    @if ($reviews->isNotEmpty())
                        @for ($i = 0; $i < $starCount; $i++)
                            ★
                        @endfor
                        @for ($i = $starCount; $i < 5; $i++)
                            ☆
                        @endfor
                        <span class="text-gray-600 text-base ml-2">({{ number_format($averageRating, 1) }} / 5) based on {{ $reviews->count() }} reviews</span>
                    @else
                        No ratings yet.
                    @endif
                </div>

                <!-- Big Description -->
                <div class="mb-8 text-gray-700 leading-relaxed text-lg">
                    <h3 class="text-2xl font-semibold mb-3 text-gray-800">About {{ $restaurant->name }}</h3>
                    <p>{{ $restaurant->description ?? 'No detailed description available.' }}</p>
                </div>
                <!-- Add to Wishlist Button -->
                @auth
                    <div class="text-center mb-8">
                       <form action="{{ route('wishlist.add', $restaurant->id) }}" method="POST">
                           @csrf
                           <button type="submit" 
                               class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition duration-300">
                               ❤️ Add to Wishlist
                           </button>
                       </form>
                    </div>
                @else
                    <p class="text-center text-gray-600 mb-8">
                        Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to add this restaurant to your wishlist.
                    </p>
                @endauth

                <!-- Brief Description about Foods -->
                <div class="mb-8 text-gray-700 leading-relaxed">
                    <h3 class="text-2xl font-semibold mb-3 text-gray-800">Our Food Menu</h3>
                    <p>{{ $restaurant->food_menu ?? 'No menu description available.' }}</p>
                </div>

                <!-- Reviews Section -->
                <div class="border-t border-gray-200 pt-8 mt-8">
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-6">Customer Reviews</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @auth
                        <!-- Review Submission Form -->
                        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">Leave a Review</h4>
                            <form action="{{ route('restaurants.reviews.store', $restaurant->id) }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating:</label>
                                    <select name="rating" id="rating" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select a rating</option>
                                        <option value="5">5 Stars - Excellent</option>
                                        <option value="4">4 Stars - Very Good</option>
                                        <option value="3">3 Stars - Good</option>
                                        <option value="2">2 Stars - Fair</option>
                                        <option value="1">1 Star - Poor</option>
                                    </select>
                                    @error('rating')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Your Review:</label>
                                    <textarea name="comment" id="comment" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Share your experience..."></textarea>
                                    @error('comment')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                   Submit Review
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-center text-gray-600 mb-8">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to leave a review.</p>
                    @endauth

                    <!-- Display Existing Reviews -->
                    @if ($reviews->isNotEmpty())
                        <div class="space-y-6">
                            @foreach ($reviews as $review)
                                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <div class="flex items-center mb-2">
                                        {{-- Assuming user has a name or email, and you can access it --}}
                                        <p class="font-semibold text-gray-800 mr-2">{{ $review->user->name ?? 'Anonymous User' }}</p>
                                        <p class="text-yellow-500">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                ★
                                            @endfor
                                            @for ($i = $review->rating; $i < 5; $i++)
                                                ☆
                                            @endfor
                                        </p>
                                    </div>
                                    <p class="text-gray-700 mb-2">{{ $review->comment }}</p>
                                    <p class="text-xs text-gray-500">Reviewed on {{ $review->created_at->format('M d, Y') }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-600">No reviews yet. Be the first to leave one!</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
