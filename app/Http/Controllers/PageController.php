<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\SuccessStory;
use App\Models\ContactMessage;
use App\Models\Review;

class PageController extends Controller
{
    // 🏠 Home Page
    public function index()
    {
        $courses = Course::latest()->take(6)->get();
        $reviews = Review::latest()->take(3)->get();

        return view('templates.index', compact('courses', 'reviews'));
    }

    // ℹ️ About Page
    public function about()
    {
        return view('templates.about');
    }

    // 📚 Courses Page
    public function courses(Request $request)
    {
        $query = Course::query()->with('lessons');

        $query->when($request->filled('search'), function ($courseQuery) use ($request) {
            $search = $request->string('search')->trim();

            $courseQuery->where(function ($searchQuery) use ($search) {
                $searchQuery->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        });

        $query->when($request->filled('level'), fn ($courseQuery) =>
            $courseQuery->where('level', $request->input('level'))
        );

        $query->when($request->filled('min_price'), fn ($courseQuery) =>
            $courseQuery->where('price', '>=', $request->input('min_price'))
        );

        $query->when($request->filled('max_price'), fn ($courseQuery) =>
            $courseQuery->where('price', '<=', $request->input('max_price'))
        );

        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_low' => $query->orderBy('price'),
            'price_high' => $query->orderByDesc('price'),
            'title' => $query->orderBy('title'),
            default => $query->latest(),
        };

        $courses = $query->paginate(12)->withQueryString();
        $levels = Course::whereNotNull('level')->distinct()->orderBy('level')->pluck('level');

        return view('templates.course', compact('courses', 'levels'));
    }

    // 📖 Course Details Page
    public function courseDetails($slug)
    {
        $course = Course::where('slug', $slug)
            ->with('lessons')
            ->firstOrFail();

        return view('templates.course-details', compact('course'));
    }

    // 📞 Contact Page
    public function contact()
    {
        return view('templates.contact');
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Your message has been sent successfully.');
    }

    public function successStories()
    {
        $successStories = SuccessStory::latest()->get();
        return view('templates.success-stories', compact('successStories'));
    }

    // public function admission()
    // {
    //     return view('templates.admission');
    // }
}