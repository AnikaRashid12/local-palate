<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Wishlist
        </h2>
    </x-slot>

    <div class="py-4 bg-pink-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($wishlist as $restaurant)
                    <div class="bg-pink-50 border border-pink-200 rounded-xl shadow-lg overflow-hidden">
                        <div class="flex justify-center items-center h-48 overflow-hidden">
                            <img src="{{ asset($restaurant->image) }}" 
                                 alt="{{ $restaurant->name }}" 
                                 class="w-full object-cover object-center">
                        </div>

                        <div class="p-4">
                            <h4 class="text-2xl font-bold text-gray-900 mb-1">{{ $restaurant->name }}</h4>
                            <p class="text-sm text-gray-700 mb-2 font-medium">Food: {{ $restaurant->food_menu ?? 'Not available' }}</p>
                            <p class="text-sm text-gray-600 mb-1">{{ $restaurant->location }}</p>
                            <p class="text-xs italic text-gray-500 mt-3 border-t border-pink-100 pt-3">"{{ $restaurant->service_review ?? 'No review yet' }}"</p>

                            {{-- Remove from Wishlist --}}
                            <form action="{{ route('wishlist.remove', $restaurant->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600">❤️ Remove</button>
                            </form>

                            <a href="{{ route('restaurants.show', $restaurant->id) }}" class="block mt-2 text-indigo-600 hover:underline">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Your wishlist is empty.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
