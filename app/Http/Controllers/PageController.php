<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notice;
use App\Models\Gallery;
use App\Models\Teacher;
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
    
    public function course()
    {
        return view('frontend/course'); 
    }
    public function courseDetails()
    {
        return view('frontend/course_details'); 
    }

    public function successStory()
    {
        return view('frontend/success-stories'); 
    }
    public function admission()
    {
        return view('frontend/admission'); 
    }

    
    
    
}