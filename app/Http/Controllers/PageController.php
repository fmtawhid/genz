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
    
    public function gallery()
    {
        $galleries = Gallery::all();
        return view('frontend/gallery', compact('galleries')); 
    }
    public function notice()
    {
        $notices = Notice::all();
        return view('frontend/notice', compact('notices') ); 
    }
    public function singelnotice($id)
    {
        // Fetch the notice by ID or throw a 404 error if it doesn't exist
        $notice = Notice::findOrFail($id);

        // Return the view and pass the notice data
        return view('frontend.singelNotice', compact('notice'));
    }





    public function about()
    {
        return view('frontend/about'); 
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