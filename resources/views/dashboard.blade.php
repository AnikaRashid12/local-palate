<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <!-- Search Form -->
            <form action="{{ route('dashboard') }}" method="GET" class="flex items-center space-x-2">
                <input type="text"
                       name="search"
                       placeholder="Search restaurants..."
                       value="{{ request('search') }}"
                       class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm px-4 py-2 text-sm w-64">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Search
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12 bg-pink-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-extrabold mb-6 text-gray-800">Restaurants</h3>

                @isset($restaurants)
                    @if ($restaurants->isEmpty() && request('search'))
                        <p class="text-center text-gray-600 text-lg">
                            No restaurants found matching "{{ request('search') }}". Please try a different search term.
                        </p>
                    @elseif ($restaurants->isEmpty())
                        <p class="text-center text-gray-600 text-lg">
                            No restaurant data available.
                        </p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($restaurants as $restaurant)
                                {{-- WRAP THE ENTIRE CARD IN AN ANCHOR TAG --}}
                                <a href="{{ route('restaurants.show', $restaurant->id) }}" class="block">
                                    <div class="bg-pink-50 border border-pink-200 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                                        <div class="flex justify-center items-center h-48 overflow-hidden">
                                            <img src="{{ asset( $restaurant->image) }}"
                                                alt="{{ $restaurant->name }}"
                                                class="w-full object-cover object-center">
                                        </div>
                                        
                                        <div class="p-6">
                                            <h4 class="text-2xl font-bold text-gray-900 mb-1">
                                                {{ $restaurant->name }}
                                            </h4>
                                            <p class="text-sm text-gray-700 mb-2 font-medium">
                                                Food: {{ $restaurant->food_menu ?? 'Not available' }}
                                            </p>
                                            <p class="text-sm text-gray-600 flex items-center mb-1">
                                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $restaurant->location }}
                                            </p>
                                            <p class="text-xs italic text-gray-500 mt-3 border-t border-pink-100 pt-3">
                                                "{{ $restaurant->service_review ?? 'No review yet' }}"
                                            </p>
                                        </div>
                                    </div>
                                </a> {{-- END OF ANCHOR TAG --}}
                            @endforeach
                        </div>
                    @endif
                @else
                    <p class="text-center text-gray-600 text-lg">
                        No restaurant data available.
                    </p>
                @endisset
            </div>
        </div>
    </div> 
</x-app-layout>