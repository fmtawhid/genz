<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request)
    {
        Review::create($this->validatedData($request));

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review created successfully.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->update($this->validatedData($request));

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    }
}
