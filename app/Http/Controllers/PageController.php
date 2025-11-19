<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notice;
use App\Models\Gallery;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\StudentReview;
class PageController extends Controller
{
    // Show Home Page
    public function contact()
    {
        return view('frontend/contact'); 
    }
    


    public function about()
    {
        $teacher = Teacher::all();
        $student_review = StudentReview::all();
        return view('frontend/about', compact('teacher', 'student_review')); 
    }
    



    public function course(Request $request)
    {
        $q = trim($request->get('q', ''));

        $courses = Course::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('short_description', 'like', "%{$q}%")
                        ->orWhere('long_description', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(3)        
            ->withQueryString(); 

        return view('frontend.course', compact('courses', 'q'));
    }


    public function courseDetails($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('frontend/course_details', compact('course')); 
    }



    public function successStory()
    {
        $reviews = StudentReview::with('course:id,title')->latest()->get();
        return view('frontend.success-stories', compact('reviews'));
    }

    public function admission()
    {
        return view('frontend/admission'); 
    }

    
    
    
}