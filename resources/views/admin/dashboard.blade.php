<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Console</h2>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 text-sm">
                Back to Main Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-pink-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded bg-green-50 text-green-800 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Add New Restaurant --}}
            <div class="bg-white shadow sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Restaurant</h3>
                <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" class="mt-1 w-full border rounded px-3 py-2" required value="{{ old('name') }}">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" class="mt-1 w-full border rounded px-3 py-2" required value="{{ old('location') }}">
                        @error('location') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Food menu (comma-separated)</label>
                        <input type="text" name="food_menu" class="mt-1 w-full border rounded px-3 py-2" placeholder="e.g. Sushi, Tempura" value="{{ old('food_menu') }}">
                        @error('food_menu') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Service review (short quote)</label>
                        <input type="text" name="service_review" class="mt-1 w-full border rounded px-3 py-2" value="{{ old('service_review') }}">
                        @error('service_review') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description (optional)</label>
                        <textarea name="description" rows="3" class="mt-1 w-full border rounded px-3 py-2" placeholder="Longer description">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 w-full border rounded px-3 py-2">
                            <option value="active" {{ old('status')==='active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status')==='inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" accept="image/*" class="mt-1 w-full border rounded px-3 py-2" required>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, WEBP up to 4MB</p>
                        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <button class="px-5 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Add Restaurant</button>
                    </div>
                </form>
            </div>

            {{-- List / Manage Restaurants --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Restaurants</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600">
                                <th class="py-2 pr-4">Name</th>
                                <th class="py-2 pr-4">Location</th>
                                <th class="py-2 pr-4">Avg Rating</th>
                                <th class="py-2 pr-4">Reviews</th>
                                <th class="py-2 pr-4">Status</th>
                                <th class="py-2 pr-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($restaurants as $r)
                                @php
                                    $count       = (int) ($r->reviews_count ?? 0);
                                    $avg         = $count > 0 ? (float) ($r->reviews_avg_rating ?? 0) : null;
                                    $isTrending  = $count >= 1 && $avg !== null && $avg > 4.0;  // your rule
                                @endphp
                                <tr>
                                    <td class="py-2 pr-4 font-medium">
                                        <div class="flex items-center gap-2">
                                            <span>{{ $r->name }}</span>
                                            @if($isTrending)
                                                <span class="px-2 py-0.5 text-[11px] rounded-full bg-pink-600 text-white shadow">🔥 Trending</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-2 pr-4">{{ $r->location }}</td>
                                    <td class="py-2 pr-4">
                                        @if($count > 0)
                                            {{ number_format($avg, 1) }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="py-2 pr-4">{{ $count }}</td>
                                    <td class="py-2 pr-4">
                                        <span class="px-2 py-1 rounded text-xs {{ ($r->status ?? 'active') === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                                            {{ ucfirst($r->status ?? 'active') }}
                                        </span>
                                    </td>
                                    <td class="py-2 pr-4">
                                        @if(isset($r->status))
                                            <form action="{{ route('admin.restaurants.toggleStatus', $r) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button class="px-3 py-1 rounded border text-sm hover:bg-gray-50">
                                                    {{ $r->status === 'active' ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('restaurants.show', $r->id) }}" class="ml-2 text-pink-700 hover:underline text-sm">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            @if($restaurants->isEmpty())
                                <tr><td colspan="6" class="py-4 text-gray-500">No restaurants yet.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- User Requests (NEW) --}}
            @isset($requests)
            <div class="bg-white shadow sm:rounded-lg p-6 mt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Requests</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600">
                                <th class="py-2 pr-4">Name</th>
                                <th class="py-2 pr-4">Location</th>
                                <th class="py-2 pr-4">Requested By</th>
                                <th class="py-2 pr-4">When</th>
                                <th class="py-2 pr-4">Image</th>
                                <th class="py-2 pr-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($requests as $req)
                                <tr>
                                    <td class="py-2 pr-4 font-medium">{{ $req->name }}</td>
                                    <td class="py-2 pr-4">{{ $req->location }}</td>
                                    <td class="py-2 pr-4">{{ optional($req->user)->name ?? '—' }}</td>
                                    <td class="py-2 pr-4">{{ optional($req->created_at)->diffForHumans() }}</td>
                                    <td class="py-2 pr-4">
                                        @if($req->image_path)
                                            <a href="{{ asset($req->image_path) }}" target="_blank" class="text-pink-700 hover:underline">View</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="py-2 pr-4">
                                        <form action="{{ route('admin.requests.approve', $req) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="px-3 py-1 rounded bg-green-600 text-white text-sm hover:bg-green-700">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.requests.reject', $req) }}" method="POST" class="inline ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-1 rounded bg-red-600 text-white text-sm hover:bg-red-700">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="py-4 text-gray-500">No requests right now.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endisset

        </div>
    </div>
</x-app-layout>
