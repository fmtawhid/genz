<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{

    public function __construct()
    {
        foreach (self::middlewareList() as $middleware => $methods) {
            $this->middleware($middleware)->only($methods);
        }
    }

    public static function middlewareList(): array
    {
        return [
            'permission:complaint_view' => ['index', 'show'],
            'permission:complaint_delete' => ['destroy'],
        ];
    }
    // Display a listing of complaints
    public function index()
    {
        $complaints = Complaint::all();
        return view('admin.complaint.index', compact('complaints'));
    }

    

    // Store a newly created complaint in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'description' => 'required|string',
        ]);

        Complaint::create($validatedData);

        return redirect()->back()->with('success', 'Complaint created successfully.');
    }

    // Display the specified complaint
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('admin.complaint.view', compact('complaint'));
    }
    
    // Remove the specified complaint from the database
    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully.');
    }
}