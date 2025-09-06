<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Request a Restaurant</h2>
            <a href="{{ route('user.dashboard') }}" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 text-sm">
                Back to My Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-pink-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <p class="mb-4 text-pink-800">
                    Can’t find your fave spot? Tell us about it and we’ll try to add it! 🍜💌
                </p>

                <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name *</label>
                        <input type="text" name="name" class="mt-1 w-full border rounded px-3 py-2" required value="{{ old('name') }}">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location *</label>
                        <input type="text" name="location" class="mt-1 w-full border rounded px-3 py-2" required value="{{ old('location') }}">
                        @error('location') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Food menu (comma-separated)</label>
                        <input type="text" name="food_menu" class="mt-1 w-full border rounded px-3 py-2" placeholder="e.g. Sushi, Tempura" value="{{ old('food_menu') }}">
                        @error('food_menu') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Short service note</label>
                        <input type="text" name="service_review" class="mt-1 w-full border rounded px-3 py-2" value="{{ old('service_review') }}">
                        @error('service_review') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3" class="mt-1 w-full border rounded px-3 py-2" placeholder="What makes it special?">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Photo (optional)</label>
                        <input type="file" name="image" accept="image/*" class="mt-1 w-full border rounded px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, WEBP up to 4MB</p>
                        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-2">
                        <button class="px-5 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
