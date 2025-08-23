<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    // ... existing properties ...

    // Define the relationship to the Review model
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function wishlistedBy() {
        return $this->belongsToMany(User::class, 'wishlists');
    }

}