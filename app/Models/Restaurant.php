<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// (optional) import if you like explicit class refs
use App\Models\Review;
use App\Models\User;

class Restaurant extends Model
{
    use HasFactory;

    // Allow mass-assignment for these columns
    protected $fillable = [
        'name',
        'location',
        'image',
        'food_menu',
        'service_review',
        'average_rating',
        'description', // short blurb for cards & detail page
    ];

    protected $casts = [
        'average_rating' => 'float',
    ];

    // Relationships
    public function reviews()
    {
        // If you didn't import Review above, use: return $this->hasMany(\App\Models\Review::class);
        return $this->hasMany(Review::class);
    }

    public function wishlistedBy()
    {
        // If you didn't import User above, use: return $this->belongsToMany(\App\Models\User::class, 'wishlists');
        return $this->belongsToMany(User::class, 'wishlists');
    }
}
