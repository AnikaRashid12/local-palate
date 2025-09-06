<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Success toast (after submitting a request) --}}
        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded bg-pink-50 text-pink-900 border border-pink-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- Top actions --}}
        <div class="mb-6 space-x-2">
            {{-- Go to Main Dashboard --}}
            <a href="{{ route('dashboard') }}" 
               class="px-4 py-2 bg-pink-500 text-red rounded hover:bg-pink-600 inline-block">
               Go to Dashboard
            </a>

            {{-- ➕ Add Request (new) --}}
            <a href="{{ route('requests.create') }}"
               class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 inline-block">
               ➕ Add Request
            </a>
        </div>

        {{-- Wishlist --}}
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-bold mb-4">My Wishlist</h3>
            @forelse($wishlist as $restaurant)
                <div class="flex justify-between items-center mb-1">
                    {{-- Clickable restaurant name --}}
                    <a href="{{ route('restaurants.show', $restaurant->id) }}" 
                       class="text-pink-600 hover:underline font-medium">
                       ❤️ {{ $restaurant->name }}
                    </a>

                    {{-- Remove button --}}
                    <form action="{{ route('wishlist.remove', $restaurant->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                            Remove
                        </button>
                    </form>
                </div>
            @empty
                <p>No restaurants in wishlist yet.</p>
            @endforelse
        </div>

        {{-- Reviews --}}
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-bold mb-4">My Reviews</h3>
            @forelse($reviews as $review)
                <p>
                    <strong>
                        <a href="{{ route('restaurants.show', $review->restaurant->id) }}" 
                           class="text-blue-600 hover:underline">
                           {{ $review->restaurant->name }}
                        </a>
                    </strong>: "{{ $review->content }}" ⭐ {{ $review->rating }}
                </p>
            @empty
                <p>You haven’t posted any reviews yet.</p>
            @endforelse
        </div>

        {{-- Top Rated / Trending Restaurants --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">Top Rated Restaurants</h3>
            @forelse($topRestaurants as $restaurant)
                <p>
                    ⭐ 
                    <a href="{{ route('restaurants.show', $restaurant->id) }}" 
                       class="text-green-600 hover:underline font-medium">
                       {{ $restaurant->name }}
                    </a> (Avg: {{ number_format($restaurant->reviews_avg_rating, 1) }})
                </p>
            @empty
                <p>No top-rated restaurants found yet.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
