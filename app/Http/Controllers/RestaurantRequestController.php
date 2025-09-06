<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestaurantRequest;

class RestaurantRequestController extends Controller
{
    // show request form
    public function create()
    {
        abort_unless(auth()->check(), 403);
        return view('requests.create');
    }

    // save request
    public function store(Request $request)
    {
        abort_unless(auth()->check(), 403);

        $data = $request->validate([
            'name'           => ['required','string','max:255'],
            'location'       => ['required','string','max:255'],
            'food_menu'      => ['nullable','string'],
            'service_review' => ['nullable','string','max:255'],
            'description'    => ['nullable','string','max:800'],
            'image'          => ['nullable','image','max:4096'], // 4MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $dir = public_path('images/requests');
            if (!is_dir($dir)) @mkdir($dir, 0775, true);
            $file = $request->file('image');
            $filename = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move($dir, $filename);
            $imagePath = 'images/requests/'.$filename;
        }

        RestaurantRequest::create([
            'user_id'        => auth()->id(),
            'name'           => $data['name'],
            'location'       => $data['location'],
            'food_menu'      => $data['food_menu'] ?? null,
            'service_review' => $data['service_review'] ?? null,
            'description'    => $data['description'] ?? null,
            'image_path'     => $imagePath,
            'status'         => 'pending',
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', '🍥 Thanks for the yummy tip! We’ll review your request soon. 💖');
    }
}
