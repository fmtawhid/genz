<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Merchant;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdmissionController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'published')->latest()->get();
        // dd($courses);
        return view('templates.admission', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id',
            'goal' => 'nullable|string',
            'attachment' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|min:6',
        ]);

        $userId = null;
        $merchantId = null;

        /*
        |--------------------------------------------------------------------------
        | If user logged in
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            $userId = Auth::id();

            $merchant = Merchant::where('user_id', $userId)->first();

            if ($merchant) {
                $merchantId = $merchant->id;
            }

        } else {

            /*
            |--------------------------------------------------------------------------
            | Create User + Merchant Automatically
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email ?? time().'@tempmail.com',
                'phone' => $request->phone,
                'password' => Hash::make($request->password ?? '12345678'),
                'role' => 'merchant',
            ]);

            $merchant = Merchant::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => '',
                'verified' => false,
                'status' => 'pending',
            ]);

            $userId = $user->id;
            $merchantId = $merchant->id;
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Attachment
        |--------------------------------------------------------------------------
        */

        $attachment = null;

        if ($request->hasFile('attachment')) {

            $attachment = $request->file('attachment')
                ->store('uploads/admissions', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Save Admission
        |--------------------------------------------------------------------------
        */

        Admission::create([
            'user_id' => $userId,
            'merchant_id' => $merchantId,
            'course_id' => $request->course_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'goal' => $request->goal,
            'attachment' => $attachment,
            'status' => 'pending',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Admission submitted successfully.');
    }
}