<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | My Joined Courses
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();

        $merchant = $user->merchant;

        $admissions = Admission::with('course')
            ->where('merchant_id', $merchant->id)
            ->latest()
            ->paginate(12);

        return view('merchant.courses.index', compact('admissions'));
    }

    /*
    |--------------------------------------------------------------------------
    | Course Details
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $user = Auth::user();

        $merchant = $user->merchant;

        $admission = Admission::with([
                'course.lessons'
            ])
            ->where('merchant_id', $merchant->id)
            ->findOrFail($id);

        return view('merchant.courses.show', compact('admission'));
    }
}