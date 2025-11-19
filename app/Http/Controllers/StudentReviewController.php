<?php

// app/Http/Controllers/StudentReviewController.php
namespace App\Http\Controllers;

use App\Models\StudentReview;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentReviewController extends Controller
{
    public function __construct()
    {
        // ইচ্ছা করলে permission middleware বসাতে পারো
        // $this->middleware('permission:review_view')->only(['index']);
        // ...
    }

    public function index()
    {
        // Simple index (চাইলে DataTables করাতে পারো)
        $reviews = StudentReview::with('course:id,title,slug')->latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $courses = Course::select('id','title')->orderBy('title')->get();
        return view('admin.reviews.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id'     => ['required','exists:courses,id'],
            'student_name'  => ['required','string','max:255'],
            'position_name' => ['nullable','string','max:255'],
            'video_url'     => ['nullable','url'],
            'body'          => ['nullable','string','max:2000'],
            'image'         => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        // handle image
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img/reviews'), $imageName);
        }

        $validated['image'] = $imageName;

        StudentReview::create($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully.');
    }

    public function edit(StudentReview $review)
    {
        $courses = Course::select('id','title')->orderBy('title')->get();
        return view('admin.reviews.edit', compact('review','courses'));
    }

    public function update(Request $request, StudentReview $review)
    {
        $validated = $request->validate([
            'course_id'     => ['required','exists:courses,id'],
            'student_name'  => ['required','string','max:255'],
            'position_name' => ['nullable','string','max:255'],
            'video_url'     => ['nullable','url'],
            'body'          => ['nullable','string','max:2000'],
            'image'         => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        if ($request->hasFile('image')) {
            // delete old
            if ($review->image && file_exists(public_path('img/reviews/'.$review->image))) {
                @unlink(public_path('img/reviews/'.$review->image));
            }
            $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img/reviews'), $imageName);
            $validated['image'] = $imageName;
        }

        $review->update($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(StudentReview $review)
    {
        if ($review->image && file_exists(public_path('img/reviews/'.$review->image))) {
            @unlink(public_path('img/reviews/'.$review->image));
        }
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }
    public function show(StudentReview $review)
    {
        // Show details of a single review
        return view('admin.reviews.show', compact('review'));
    }
}
