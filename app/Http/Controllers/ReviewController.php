<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::with(['product', 'user'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id'    => 'nullable|exists:users,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        return Review::create($validated);
    }

    public function show(Review $review)
    {
        return $review->load(['product', 'user']);
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'rating'  => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);

        return $review;
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->noContent();
    }
}
