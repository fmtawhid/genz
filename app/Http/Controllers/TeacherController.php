<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\TeacherAttachment;
use DataTables;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
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
            'permission:teacher_view' => ['index'],
            'permission:teacher_add' => ['create', 'store'],
            'permission:teacher_edit' => ['edit', 'update'],
            'permission:teacher_delete' => ['destroy'],
        ];
    }
    
    
    public function index()
    {
        $teachers = Teacher::latest()->get();

        if (request()->ajax()) {
            return DataTables::of($teachers)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('teacher.destroy', $row);
                    $edit_api = route('teacher.edit', $row);
                    $csrf = csrf_token();
                
                    $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>";
                
                    if (auth()->user()->can('teacher_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit teacher details'>
                            <i class='ri-edit-box-fill'></i>
                        </a>";
                    }
                
                    // ✅ Show ID card button only if user_id exists
                    if (auth()->user() && $row->user_id) {
                        $generate_id_api = route('admin.teacher.generateID', ['user_id' => $row->user_id]);
                        $action .= "<a class='btn btn-primary btn-sm m-1' href='$generate_id_api' title='Generate ID Card'>
                            <i class='ri-id-card-line'></i> ID Card
                        </a>";
                    }
                
                    if (auth()->user()->can('teacher_delete')) {
                        $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1'>
                            <i class='ri-delete-bin-fill'></i>
                        </button>";
                    }
                
                    $action .= "</form>";
                
                    return $action;
                })
                
                
                // ->addColumn('actions', function ($row) {
                //     $delete_api = route('teacher.destroy', $row);
                //     $edit_api = route('teacher.edit', $row);
                //     $csrf = csrf_token();

                //     // Start the form for the delete button
                //     $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                //         <input name='_method' type='hidden' value='DELETE'>
                //         <input name='_token' type='hidden' value='$csrf'>";

                //     // Add Edit Button if the user has the 'teacher_edit' permission
                //     if (auth()->user()->can('teacher_edit')) {
                //         $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit teacher details'>
                //             <i class='ri-edit-box-fill'></i>
                //         </a>";
                //     }

                //     // Add Delete Button if the user has the 'teacher_delete' permission
                //     if (auth()->user()->can('teacher_delete')) {
                //         $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1'>
                //             <i class='ri-delete-bin-fill'></i>
                //         </button>";
                //     }

                //     // Close the form tag
                //     $action .= "</form>";

                //     return $action;
                // })
                ->addColumn('phone_number', function($row) {
                    return $row->phone_number;
                })
                ->addColumn('email', function($row) {
                    return $row->email;
                })
                ->addColumn('address', function($row) {
                    return $row->address;
                })
                ->addColumn('facebook_link', function($row) {
                    return $row->facebook_link;
                })
                ->addColumn('date_of_joining', function($row) {
                    return $row->date_of_joining;
                })
                ->addColumn('salary', function($row) {
                    return $row->salary;
                })
                ->addColumn('qualification', function($row) {
                    return $row->qualification;
                })
                ->addColumn('status', function($row) {
                    return $row->status;
                })
                ->addColumn('years_of_experience', function($row) {
                    return $row->years_of_experience;
                })
                ->addColumn('department', function($row) {
                    return $row->department;
                })
                ->addColumn('staff_type', function($row) {
                    return $row->staff_type;
                })
                ->addColumn('date_of_birth', function($row) {
                    return $row->date_of_birth ? \Carbon\Carbon::parse($row->date_of_birth)->format('d-m-Y') : 'N/A';
                })
                ->addColumn('blood_group', function($row) {
                    return $row->blood_group;
                })
                ->addColumn('user_id', function($row) {
                    return $row->user_id;
                })
                ->rawColumns(['created_at_read', 'actions']) // Make sure the 'actions' column is rendered as raw HTML
                ->make(true);
        }

        return view('admin.teachers.index', compact('teachers'));
    }



    // Show the form to create a new teacher
    public function create()
    {
        return view('admin.teachers.create');
    } 

 
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'facebook_link' => 'nullable|url',
            'date_of_joining' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'qualification' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'years_of_experience' => 'nullable|integer',
            'department' => 'nullable|string|max:255',
            'staff_type'    => 'required|in:teacher,staff',
            'date_of_birth' => 'nullable|date',
            'blood_group'   => 'nullable|string|max:3',
            'user_id'       => 'nullable|string|unique:teachers,user_id',
            'nid_number' => 'nullable|string|unique:teachers,nid_number',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // attachments validation

        ]);

        // Handle the image upload if any
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/teachers'), $imageName);
        }

        // Create a new teacher
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->designation = $request->designation;
        $teacher->image = $imageName;
        $teacher->phone_number = $request->phone_number;
        $teacher->email = $request->email;
        $teacher->address = $request->address;
        $teacher->facebook_link = $request->facebook_link;
        $teacher->date_of_joining = $request->date_of_joining;
        $teacher->salary = $request->salary;
        $teacher->qualification = $request->qualification;
        $teacher->status = $request->status;
        $teacher->years_of_experience = $request->years_of_experience;
        $teacher->department = $request->department;
        $teacher->staff_type = $request->staff_type;
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->blood_group = $request->blood_group;
        $teacher->user_id = $request->user_id;
        $teacher->nid_number = $request->nid_number;

        $teacher->save();

        // Handle new attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                TeacherAttachment::create([
                    'teacher_id' => $teacher->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $filenameWithExt,
                    'file_type' => $extension
                ]);
            }
        }

        // Redirect with success message
        // return redirect()->route('teacher.list')->with('success', 'Teacher added successfully!');
        return response()->json(['success' => "Teacher created Successfully"]);
    }


    // Show the form to edit an existing teacher
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    // // Update an existing teacher
    // public function update(Request $request, $id)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'designation' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $teacher = Teacher::findOrFail($id);

    //     // Handle image update (if a new image is uploaded)
    //     $imageName = $teacher->image; // Keep existing image
    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '.' . $request->image->extension();
    //         $request->image->move(public_path('img/teachers'), $imageName); // Save the new image
    //     }

    //     // Update teacher data
    //     $teacher->name = $request->name;
    //     $teacher->designation = $request->designation;
    //     $teacher->image = $imageName;
    //     $teacher->save();

    //     // Redirect with success message
    //     return redirect()->route('teacher.list')->with('success', 'Teacher updated successfully!');
    // }
    public function update(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'phone_number' => 'nullable|string|max:15',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string|max:500',
        'facebook_link' => 'nullable|url',
        'date_of_joining' => 'nullable|date',
        'salary' => 'nullable|numeric',
        'qualification' => 'nullable|string|max:255',
        'status' => 'nullable|string|in:active,inactive',
        'years_of_experience' => 'nullable|integer',
        'department' => 'nullable|string|max:255',
        'staff_type' => 'nullable|string|in:teacher,staff',
        'date_of_birth' => 'nullable|date',
        'blood_group' => 'nullable|string|max:5',
        'user_id' => 'nullable|string|max:255', // Validate user_id
        'nid_number' => 'nullable|string|unique:teachers,nid_number',
        'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // attachments validation
    ]);

    $teacher = Teacher::findOrFail($id);

    // Handle image update (if a new image is uploaded)
    $imageName = $teacher->image; // Keep existing image
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img/teachers'), $imageName);
    }

    // Update teacher data
    $teacher->name = $request->name;
    $teacher->designation = $request->designation;
    $teacher->image = $imageName;
    $teacher->phone_number = $request->phone_number;
    $teacher->email = $request->email;
    $teacher->address = $request->address;
    $teacher->facebook_link = $request->facebook_link;
    $teacher->date_of_joining = $request->date_of_joining;
    $teacher->salary = $request->salary;
    $teacher->qualification = $request->qualification;
    $teacher->status = $request->status;
    $teacher->years_of_experience = $request->years_of_experience;
    $teacher->department = $request->department;
    $teacher->staff_type = $request->staff_type;
    $teacher->date_of_birth = $request->date_of_birth;
    $teacher->blood_group = $request->blood_group;
    $teacher->user_id = $request->user_id;
    $teacher->nid_number = $request->nid_number;


    // Handle attachment updates if any attachments are being uploaded
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $attachment) {
            $fileName = time() . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('assets/attachments'), $fileName);

            // Save the attachment to the database
            $teacher->attachments()->create([
                'file_path' => $fileName,
                'file_name' => $attachment->getClientOriginalName(),
                'file_type' => $attachment->getClientOriginalExtension(),
            ]);
        }
    }

    // Handle deletion of old attachments if specified
    if ($request->has('delete_attachments')) {
        foreach ($request->delete_attachments as $attachmentId) {
            $attachment = $teacher->attachments()->find($attachmentId);
            if ($attachment) {
                // Delete file from the filesystem
                @unlink(public_path('assets/attachments/' . $attachment->file_path));
                // Delete the attachment record from the database
                $attachment->delete();
            }
        }
    }

    // Save teacher data
    $teacher->save();

    // Redirect with success message
    return redirect()->route('teacher.list')->with('success', 'Teacher updated successfully!');
}

    // public function update(Request $request, $id)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'designation' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'phone_number' => 'nullable|string|max:15',
    //         'email' => 'nullable|email|max:255',
    //         'address' => 'nullable|string|max:500',
    //         'facebook_link' => 'nullable|url',
    //         'date_of_joining' => 'nullable|date',
    //         'salary' => 'nullable|numeric',
    //         'qualification' => 'nullable|string|max:255',
    //         'status' => 'nullable|string|in:active,inactive',
    //         'years_of_experience' => 'nullable|integer',
    //         'department' => 'nullable|string|max:255',
    //         'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // attachments validation

    //     ]);

    //     $teacher = Teacher::findOrFail($id);

    //     // Handle image update (if a new image is uploaded)
    //     $imageName = $teacher->image; // Keep existing image
    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '.' . $request->image->extension();
    //         $request->image->move(public_path('img/teachers'), $imageName);
    //     }

    //     // Update teacher data
    //     $teacher->name = $request->name;
    //     $teacher->designation = $request->designation;
    //     $teacher->image = $imageName;
    //     $teacher->phone_number = $request->phone_number;
    //     $teacher->email = $request->email;
    //     $teacher->address = $request->address;
    //     $teacher->facebook_link = $request->facebook_link;
    //     $teacher->date_of_joining = $request->date_of_joining;
    //     $teacher->salary = $request->salary;
    //     $teacher->qualification = $request->qualification;
    //     $teacher->status = $request->status;
    //     $teacher->years_of_experience = $request->years_of_experience;
    //     $teacher->department = $request->department;
    //     $teacher->save();

    //     // Redirect with success message
    //     return redirect()->route('teacher.list')->with('success', 'Teacher updated successfully!');
    // }


    // Delete an existing teacher
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        // Delete the image if it exists
        if ($teacher->image) {
            Storage::delete(public_path('img/teachers/' . $teacher->image));  // Delete the image from storage
        }

        // Delete the teacher from the database
        $teacher->delete();

        return redirect()->route('teacher.list')->with('success', 'Teacher deleted successfully!');
    }




    public function generateID($user_id)
    {
        // Fetch the student based on dhakila_number instead of id
        $teacher = Teacher::where('user_id', $user_id)->firstOrFail();

        return view('admin.teachers.id_card', compact('teacher',));
    }
}
