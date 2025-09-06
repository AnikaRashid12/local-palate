<x-app-layout>
    <x-slot name="header">
        <div x-data="{ openFilter:false }" class="flex justify-between items-center relative">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <div class="flex items-center space-x-2">
                <!-- Search -->
                <form action="{{ route('dashboard') }}" method="GET" class="flex items-center space-x-2">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search restaurants..."
                        value="{{ request('search') }}"
                        class="border-gray-300 focus:border-pink-400 focus:ring focus:ring-pink-200 focus:ring-opacity-50 rounded-md shadow-sm px-4 py-2 text-sm w-64"
                    />
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-pink-700 active:bg-pink-800 focus:outline-none focus:ring focus:ring-pink-300 transition"
                    >
                        Search
                    </button>

                    {{-- keep filters when searching (no rating fields) --}}
                    <input type="hidden" name="location" value="{{ request('location') }}">
                    <input type="hidden" name="cuisine" value="{{ request('cuisine') }}">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                </form>

                {{-- Quick cuisine chips (edit list anytime) --}}
                @php $quickCuisines = ['Sushi','Pizza','Burgers','Pasta','Dessert']; @endphp
                <div class="hidden md:flex items-center gap-2 ml-2">
                    @foreach ($quickCuisines as $quick)
                        <a href="{{ route('dashboard', array_merge(request()->except('page'), ['cuisine'=>$quick])) }}"
                           class="px-3 py-1 rounded-full bg-white/70 border border-pink-200 text-pink-700 text-xs hover:bg-white transition">
                            {{ $quick }}
                        </a>
                    @endforeach
                </div>

                <!-- My Wishlist -->
                <a href="{{ route('wishlist.index') }}"
                   class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 font-semibold text-sm">
                    My Wishlist
                </a>

                <!-- My User Dashboard (role-aware) -->
                @auth
                    @if (strcasecmp(auth()->user()->role ?? '', 'admin') === 0)
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 font-semibold text-sm">
                            My User Dashboard
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}"
                           class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 font-semibold text-sm">
                            My User Dashboard
                        </a>
                    @endif
                @endauth

                <!-- Filter dropdown (anchored under the button) -->
                <div class="relative">
                    <button type="button"
                            @click="openFilter = !openFilter"
                            class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 font-semibold text-sm">
                        Filter
                    </button>

                    <!-- Panel -->
                    <div x-cloak
                         x-show="openFilter"
                         x-transition
                         @click.outside="openFilter = false"
                         class="absolute right-0 top-full mt-2 w-[26rem] bg-white/95 border border-pink-200 rounded-2xl shadow-xl p-5 z-50">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-semibold text-pink-900">Filter Restaurants</h3>
                            <button type="button" @click="openFilter=false" class="text-pink-700 hover:text-pink-900">✕</button>
                        </div>

                        @php
                            // If $locations not provided from controller, derive from current results
                            $locationsList = isset($locations)
                                ? collect($locations)
                                : (isset($restaurants) ? $restaurants->pluck('location')->filter()->unique()->sort() : collect());
                            $sortSel = request('sort', 'rating_desc');
                        @endphp

                        <form method="GET" action="{{ route('dashboard') }}" class="space-y-4" @submit="openFilter=false">
                            <input type="hidden" name="search" value="{{ request('search') }}"/>

                            <!-- Location -->
                            <div>
                                <label class="block text-sm font-medium text-pink-900">Location</label>
                                <select name="location"
                                        class="mt-1 w-full rounded-md border border-pink-300 px-3 py-2 focus:border-pink-500 focus:ring-pink-200">
                                    <option value="">Any</option>
                                    @foreach($locationsList as $loc)
                                        <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>
                                            {{ $loc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Cuisine contains -->
                            <div>
                                <label class="block text-sm font-medium text-pink-900">Cuisine contains</label>
                                <input type="text" name="cuisine" value="{{ request('cuisine') }}" placeholder="e.g. Sushi, Pizza"
                                       class="mt-1 w-full rounded-md border border-pink-300 px-3 py-2 focus:border-pink-500 focus:ring-pink-200" />
                            </div>

                            <!-- Sort -->
                            <div>
                                <label class="block text-sm font-medium text-pink-900">Sort by</label>
                                <select name="sort"
                                        class="mt-1 w-full rounded-md border border-pink-300 px-3 py-2 focus:border-pink-500 focus:ring-pink-200">
                                    <option value="rating_desc" {{ $sortSel==='rating_desc' ? 'selected' : '' }}>Rating (High → Low)</option>
                                    <option value="rating_asc"  {{ $sortSel==='rating_asc'  ? 'selected' : '' }}>Rating (Low → High)</option>
                                    <option value="name_asc"    {{ $sortSel==='name_asc'    ? 'selected' : '' }}>Name (A → Z)</option>
                                    <option value="name_desc"   {{ $sortSel==='name_desc'   ? 'selected' : '' }}>Name (Z → A)</option>
                                </select>
                            </div>

                            <div class="flex gap-2 pt-2">
                                <button class="px-4 py-2 rounded-full bg-pink-600 hover:bg-pink-700 text-white font-semibold">
                                    Apply
                                </button>
                                <a href="{{ route('dashboard') }}"
                                   class="px-4 py-2 rounded-full bg-pink-100 hover:bg-pink-200 text-pink-800 font-medium">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Filter dropdown -->
            </div>
        </div>
    </x-slot>

    <div class="py-4 bg-pink-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h3 class="text-2xl font-extrabold mb-2 text-gray-800">Restaurants</h3>

                @isset($restaurants)
                    @if ($restaurants->isEmpty() && request('search'))
                        <p class="text-center text-gray-600 text-lg">
                            No restaurants found matching "{{ request('search') }}".
                        </p>
                    @elseif ($restaurants->isEmpty())
                        <p class="text-center text-gray-600 text-lg">
                            No restaurant data available.
                        </p>
                    @else
                        @php $trendingMin = 4.5; @endphp
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($restaurants as $restaurant)
                                <a href="{{ route('restaurants.show', $restaurant->id) }}" class="block">
                                    <div class="relative bg-pink-50 border border-pink-200 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                                        {{-- 🔥 Trending badge: ONLY if there is at least 1 rating AND avg >= threshold --}}
                                        @php
                                            // average rating (may be null or string)
                                            $avg = $restaurant->average_rating ?? null;
                                            $avg = is_numeric($avg) ? (float)$avg : null;

                                            // try multiple common count fields or loaded relations
                                            $cnt =
                                                ($restaurant->ratings_count ?? null) ??
                                                ($restaurant->reviews_count ?? null) ??
                                                ($restaurant->rating_count  ?? null);

                                            if (is_null($cnt)) {
                                                if (isset($restaurant->ratings) && $restaurant->ratings instanceof \Illuminate\Support\Collection) {
                                                    $cnt = $restaurant->ratings->count();
                                                } elseif (isset($restaurant->reviews) && $restaurant->reviews instanceof \Illuminate\Support\Collection) {
                                                    $cnt = $restaurant->reviews->count();
                                                } else {
                                                    $cnt = 0;
                                                }
                                            } else {
                                                $cnt = (int)$cnt;
                                            }

                                            $isTrending = !is_null($avg) && $cnt > 0 && $avg >= $trendingMin;
                                        @endphp

                                        @if($isTrending)
                                            <span class="absolute top-2 right-2 px-2 py-1 text-[11px] rounded-full bg-pink-600 text-white shadow">
                                                🔥 Trending
                                            </span>
                                        @endif

                                        <div class="flex justify-center items-center h-48 overflow-hidden">
                                            <img src="{{ asset($restaurant->image) }}"
                                                 alt="{{ $restaurant->name }}"
                                                 class="w-full object-cover object-center">
                                        </div>

                                        <div class="p-4">
                                            <h4 class="text-2xl font-bold text-gray-900 mb-1">{{ $restaurant->name }}</h4>
                                            <p class="text-sm text-gray-700 mb-2 font-medium">
                                                Food: {{ $restaurant->food_menu ?? 'Not available' }}
                                            </p>
                                            <p class="text-sm text-gray-600 flex items-center mb-1">{{ $restaurant->location }}</p>
                                            <p class="text-xs italic text-gray-500 mt-3 border-t border-pink-100 pt-3">
                                                "{{ $restaurant->service_review ?? 'No review yet' }}"
                                            </p>

                        {{-- Wishlist Toggle Button --}}
                        <form action="{{ Auth::user()->wishlist->contains($restaurant->id) ? route('wishlist.remove', $restaurant->id) : route('wishlist.add', $restaurant->id) }}" method="POST" class="mt-2">
                            @csrf
                            @if(Auth::user()->wishlist->contains($restaurant->id))
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600">❤️ Remove</button>
                            @else
                                <button type="submit" class="px-4 py-2 rounded bg-pink-600 text-white hover:bg-pink-700">🤍 Add to Wishlist</button>
                            @endif
                        </form>
                                        </div>
                                    </div>
                                </a>
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
