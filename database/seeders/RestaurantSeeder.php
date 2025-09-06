<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $rows = [
            [
                'name' => 'The Cozy Corner',
                'location' => '123 Main Street',
                'image' => 'images/restaurants/cozy-corner.jpg',
                'food_menu' => 'Pizza, Pasta, Salads',
                'service_review' => 'Great ambiance and friendly staff.',
                'average_rating' => 4.5,
                'description' =>
                    "Warm lighting and comfy booths welcome you in.\n".
                    "Family recipes meet a playful modern twist.\n".
                    "Wood-fired pizzas with crackly edges and rich sauce.\n".
                    "Fresh pastas tossed with seasonal vegetables.\n".
                    "A neighborhood spot that feels like home.\n".
                    "Save room for the tiramisu—silky and not too sweet.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Sushi Delight',
                'location' => '456 Ocean Avenue',
                'image' => 'images/restaurants/sushi-delight.jpg',
                'food_menu' => 'Sushi, Sashimi, Tempura',
                'service_review' => 'Fresh fish and quick service.',
                'average_rating' => 4.8,
                'description' =>
                    "Pristine cuts of fish, plated like little works of art.\n".
                    "Rice is seasoned just right—soft with a gentle bite.\n".
                    "Tempura stays light, crisp, and never greasy.\n".
                    "Ask the chef for the seasonal nigiri flight.\n".
                    "Minimalist room, soothing music, ocean breeze.\n".
                    "Green tea cheesecake is a quiet show-stopper.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Burger Haven',
                'location' => '789 Grill Street',
                'image' => 'images/restaurants/burger-heaven.jpg',
                'food_menu' => 'Burgers, Fries, Shakes',
                'service_review' => 'Juicy burgers and crispy fries.',
                'average_rating' => 4.3,
                'description' =>
                    "Smash-seared patties with caramelized edges.\n".
                    "Sesame buns toasted to a buttery gloss.\n".
                    "House pickles add snap, house sauce adds zing.\n".
                    "Fries are double-cooked: fluffy inside, crisp outside.\n".
                    "Milkshakes thick enough to stand your straw.\n".
                    "Plenty of napkins—things get deliciously messy.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Pasta Palace',
                'location' => '321 Noodle Avenue',
                'image' => 'images/restaurants/pasta-palace.jpg',
                'food_menu' => 'Spaghetti, Ravioli, Lasagna',
                'service_review' => 'Authentic Italian taste.',
                'average_rating' => 4.6,
                'description' =>
                    "Hand-rolled pasta with that tender bite.\n".
                    "Slow-simmered sauces layered with depth.\n".
                    "Ravioli stuffed generously, never stingy.\n".
                    "Garlic bread that crackles when you tear it.\n".
                    "A cozy bustle, clinking glasses, friendly chatter.\n".
                    "Nonna would absolutely approve.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Taco Town',
                'location' => '654 Fiesta Street',
                'image' => '/images/restaurants/taco-town.jpg',
                'food_menu' => 'Tacos, Nachos, Burritos',
                'service_review' => 'Spicy and flavorful.',
                'average_rating' => 4.4,
                'description' =>
                    "Soft corn tortillas warmed on a hot plancha.\n".
                    "Carnitas are citrusy, barbacoa is deeply savory.\n".
                    "Salsas range from bright to blistering.\n".
                    "Crunchy slaw keeps every bite fresh.\n".
                    "Grab a jarritos and post up on the patio.\n".
                    "Tuesday deals are legendary around here.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Green Garden',
                'location' => '88 Veggie Lane',
                'image' => 'images/restaurants/green-garden.jpg',
                'food_menu' => 'Salads, Smoothies, Bowls',
                'service_review' => 'Fresh and healthy.',
                'average_rating' => 4.7,
                'description' =>
                    "Colorful bowls stacked with crunch and creaminess.\n".
                    "Herby dressings made in-house every morning.\n".
                    "Proteins from grilled tofu to citrus-rubbed chicken.\n".
                    "Seasonal specials follow the local markets.\n".
                    "Smoothies taste like sunshine in a glass.\n".
                    "Light, bright, and energizing without fuss.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Curry House',
                'location' => '909 Spice Road',
                'image' => 'images/restaurants/curry-house.jpg',
                'food_menu' => 'Chicken Curry, Naan, Biryani',
                'service_review' => 'Rich spices and aroma.',
                'average_rating' => 4.2,
                'description' =>
                    "Gravies simmered low and slow for deep flavor.\n".
                    "Fragrant basmati rice, each grain distinct.\n".
                    "Tandoor-blistered naan, soft and smoky.\n".
                    "Heat levels from gentle warmth to joyful fire.\n".
                    "Pickles and raita keep things balanced.\n".
                    "A comfort food destination on rainy nights.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Seafood Shack',
                'location' => '22 Dockside Drive',
                'image' => 'images/restaurants/the-seafood-shack.jpg',
                'food_menu' => 'Lobster, Crab, Clams',
                'service_review' => 'Perfect for seafood lovers.',
                'average_rating' => 4.1,
                'description' =>
                    "Butter-slick lobster rolls on toasted buns.\n".
                    "Clam chowder that hugs the soul.\n".
                    "Crab cakes loaded with crab, not filler.\n".
                    "Lemon wedges and hot sauce at every table.\n".
                    "Harbor views when the weather plays nice.\n".
                    "Casual, breezy, bring your appetite.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Breakfast Barn',
                'location' => '77 Sunrise Blvd',
                'image' => 'images/restaurants/breakfast-barn.jpg',
                'food_menu' => 'Pancakes, Eggs, Coffee',
                'service_review' => 'Cozy and filling morning meals.',
                'average_rating' => 4.6,
                'description' =>
                    "Stacked pancakes with crisp edges and fluffy hearts.\n".
                    "Farm eggs any style, yolks like liquid gold.\n".
                    "Hash browns griddled to perfect crunch.\n".
                    "House jam and warm maple syrup on standby.\n".
                    "Bottomless coffee that actually tastes great.\n".
                    "The kind of breakfast that resets your day.",
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Dessert Dreams',
                'location' => '66 Sugar Street',
                'image' => 'images/restaurants/dessert-dreams.jpg',
                'food_menu' => 'Cakes, Ice Cream, Pastries',
                'service_review' => 'Sweet heaven on a plate.',
                'average_rating' => 4.9,
                'description' =>
                    "Glass cases filled with delicate pastries.\n".
                    "Cakes that balance richness with restraint.\n".
                    "Seasonal tarts crowned with glossy fruit.\n".
                    "House-churned ice creams, ultra-creamy.\n".
                    "Espresso drinks to cut the sweetness.\n".
                    "A fairy-light finish to any evening.",
                'created_at' => $now, 'updated_at' => $now,
            ],
        ];

        // ✅ Upsert: updates existing rows matched by 'name' or inserts if missing.
        DB::table('restaurants')->upsert(
            $rows,
            ['name'], // match by name (ensure names are unique in your data)
            ['location','image','food_menu','service_review','average_rating','description','updated_at']
        );

        // If you truly prefer the original insert behavior (may create duplicates), use:
        // DB::table('restaurants')->insert($rows);
    }
}
