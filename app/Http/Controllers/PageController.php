<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class PageController extends Controller
{
    // 🏠 Home Page
    public function index()
    {
        $courses = Course::latest()->take(6)->get();
        return view('templates.index', compact('courses'));
    }

    // ℹ️ About Page
    public function about()
    {
        return view('templates.about');
    }

    // 📚 Courses Page
    public function courses()
    {
        $courses = Course::latest()->paginate(12);
        return view('templates.course', compact('courses'));
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

    public function successStories()
    {
        return view('templates.success-stories');
    }

    public function admission()
    {
        return view('templates.admission');
    }
}