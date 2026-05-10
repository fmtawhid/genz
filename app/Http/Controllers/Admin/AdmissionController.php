<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admission List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $admissions = Admission::with([
                'course',
                'merchant',
                'user'
            ])
            ->latest()
            ->paginate(10);

        return view('admin.admissions.index', compact('admissions'));
    }

    /*
    |--------------------------------------------------------------------------
    | Admission Details
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $admission = Admission::with([
                'course',
                'merchant',
                'user'
            ])
            ->findOrFail($id);

        return view('admin.admissions.show', compact('admission'));
    }

    /*
    |--------------------------------------------------------------------------
    | Status Update
    |--------------------------------------------------------------------------
    */

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $admission = Admission::findOrFail($id);

        $admission->update([
            'status' => $request->status
        ]);

        return redirect()->back()
            ->with('success', 'Admission status updated successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $admission = Admission::findOrFail($id);

        if ($admission->attachment &&
            file_exists(public_path('storage/' . $admission->attachment))) {

            unlink(public_path('storage/' . $admission->attachment));
        }

        $admission->delete();

        return redirect()->back()
            ->with('success', 'Admission deleted successfully');
    }
}