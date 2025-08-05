<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        DB::table('restaurants')->insert([
            [
                'name' => 'The Cozy Corner',
                'location' => '123 Main Street',
                'image' => 'images/restaurants/cozy-corner.jpg',
                'food_menu' => 'Pizza, Pasta, Salads',
                'service_review' => 'Great ambiance and friendly staff.',
                'average_rating' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sushi Delight',
                'location' => '456 Ocean Avenue',
                'image' => 'images/restaurants/sushi-delight.jpg',
                'food_menu' => 'Sushi, Sashimi, Tempura',
                'service_review' => 'Fresh fish and quick service.',
                'average_rating' => 4.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Burger Haven',
                'location' => '789 Grill Street',
                'image' => 'images/restaurants/burger-heaven.jpg',
                'food_menu' => 'Burgers, Fries, Shakes',
                'service_review' => 'Juicy burgers and crispy fries.',
                'average_rating' => 4.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pasta Palace',
                'location' => '321 Noodle Avenue',
                'image' => 'images/restaurants/pasta-palace.jpg',
                'food_menu' => 'Spaghetti, Ravioli, Lasagna',
                'service_review' => 'Authentic Italian taste.',
                'average_rating' => 4.6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taco Town',
                'location' => '654 Fiesta Street',
                'image' => '/images/restaurants/taco-town.jpg',
                'food_menu' => 'Tacos, Nachos, Burritos',
                'service_review' => 'Spicy and flavorful.',
                'average_rating' => 4.4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Green Garden',
                'location' => '88 Veggie Lane',
                'image' => 'images/restaurants/green-garden.jpg',
                'food_menu' => 'Salads, Smoothies, Bowls',
                'service_review' => 'Fresh and healthy.',
                'average_rating' => 4.7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Curry House',
                'location' => '909 Spice Road',
                'image' => 'images/restaurants/curry-house.jpg',
                'food_menu' => 'Chicken Curry, Naan, Biryani',
                'service_review' => 'Rich spices and aroma.',
                'average_rating' => 4.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Seafood Shack',
                'location' => '22 Dockside Drive',
                'image' => 'images/restaurants/the-seafood-shack.jpg',
                'food_menu' => 'Lobster, Crab, Clams',
                'service_review' => 'Perfect for seafood lovers.',
                'average_rating' => 4.1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Breakfast Barn',
                'location' => '77 Sunrise Blvd',
                'image' => 'images/restaurants/breakfast-barn.jpg',
                'food_menu' => 'Pancakes, Eggs, Coffee',
                'service_review' => 'Cozy and filling morning meals.',
                'average_rating' => 4.6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dessert Dreams',
                'location' => '66 Sugar Street',
                'image' => 'images/restaurants/dessert-dreams.jpg',
                'food_menu' => 'Cakes, Ice Cream, Pastries',
                'service_review' => 'Sweet heaven on a plate.',
                'average_rating' => 4.9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
