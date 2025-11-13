<?php

namespace App\Http\Controllers;

use App\Models\Location;  // ← THIS LINE WAS MISSING
use App\Models\Review;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function show(Location $location)
    {
        // Eager load reviews + comments + users
        $location->load(['reviews.user', 'reviews.comments.user']);

        return view('locations.show', compact('location'));
    }

    public function storeReview(Request $request, Location $location)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:2000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
        ]);

        $review = $location->reviews()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'photo' => $request->hasFile('photo')
                ? $request->file('photo')->store('reviews', 'public')
                : null,
        ]);

        return back()->with('success', 'Review posted!');
    }

    public function storeComment(Request $request, Review $review)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $review->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Comment added!');
    }
}