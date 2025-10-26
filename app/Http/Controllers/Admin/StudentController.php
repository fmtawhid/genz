<?php

namespace App\Http\Controllers\Admin;
use App\Models\OptionalService;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Models\Bibag;
use App\Models\Sreni;
use App\Models\Student;
use App\Models\Payment;
use App\Models\attendance;
use App\Models\StudentAttachment;
use App\Models\User;
use App\Models\FeeCategory;
use App\Models\Exam;
use App\Models\AssignedFee;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class StudentController extends Controller
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
            'permission:student_view' => ['index', 'show'],
            'permission:student_add' => ['create', 'store'],
            'permission:student_edit' => ['edit', 'update'],
            'permission:student_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        // Retrieve date filters from the request
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";


        $students = Student::with('attachments')
            ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
            ->select('students.*', 'bibags.name as bibag_name')
            ->latest();

        // Apply date filters if provided
        if ($fromDate && $toDate) {
            if ($fromDate > $toDate) {
                return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
            }

            $students->whereDate('students.created_at', '>=', $fromDate)
                ->whereDate('students.created_at', '<=', $toDate);
        } elseif ($fromDate) {
            $students->whereDate('students.created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $students->whereDate('students.created_at', '<=', $toDate);
        }

        

       

        if (request()->ajax()) {
            return DataTables::of($students)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('dhakila_date', function ($row) {
                    $date = $row->dhakila_date ? new Carbon($row->dhakila_date) : null;
                    return $date ? $date->format("d-m-Y") : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('students.destroy', $row);
                    $edit_api = route('students.edit', $row);
                    $view_api = route('students.show', ['dhakila_number' => $row->dhakila_number]);
                    // $id_generate = route('student.generateID', ['dhakila_number' => $row->dhakila_number]);
                    $csrf = csrf_token();

                    // Start the action buttons section
                    $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>";

                    // Add Edit Button if the user has the 'student_edit' permission
                    if (auth()->user()->can('student_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit student details'>
                            <i class='ri-edit-box-fill'></i>
                        </a>";
                    }

                    // Add Delete Button if the user has the 'student_delete' permission
                    if (auth()->user()->can('student_delete')) {
                        $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' title='Delete student'>
                            <i class='ri-delete-bin-fill'></i>
                        </button>";
                    }

                    // Close the form tag
                    $action .= "</form>";

                    // Add additional buttons (View Attachments, View Details, Generate ID Card)
                    $action .= "<button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                        <i class='ri-eye-fill'></i>
                    </button>";

                    // View Details Button
                    $action .= "<a href='$view_api' class='btn btn-primary btn-sm m-1' title='View Student Details'>
                        <i class='ri-eye-fill'></i> View Details
                    </a>";

                    // Generate ID Card Button
    
                    return $action;
                })
                ->rawColumns(['created_at_read', 'actions']) // Render 'actions' column as raw HTML
                ->make(true);
        }

        // Fetch bibags and srenis for filters
        $bibags = Bibag::latest()->get();
        $srenis = Sreni::latest()->get();

        return view('admin.student.index', compact('students', 'bibags', 'srenis'));
    }

    public function indexInactive(Request $request)
    {
        // Retrieve date filters from the request
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
        $bibagId = $request->input('bibag_id');

        $students = Student::with('attachments')
            ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
            ->select('students.*', 'bibags.name as bibag_name')
            ->latest();

        $students->where('students.type', 'deactive');

        // Apply date filters if provided
        if ($fromDate && $toDate) {
            if ($fromDate > $toDate) {
                return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
            }

            $students->whereDate('students.created_at', '>=', $fromDate)
                ->whereDate('students.created_at', '<=', $toDate);
        } elseif ($fromDate) {
            $students->whereDate('students.created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $students->whereDate('students.created_at', '<=', $toDate);
        }

        if ($bibagId) {
            $students->where('bibags.id', $bibagId);
        }

        if (request()->ajax()) {
            return DataTables::of($students)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('dhakila_date', function ($row) {
                    $date = $row->dhakila_date ? new Carbon($row->dhakila_date) : null;
                    return $date ? $date->format("d-m-Y") : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('students.destroy', $row);
                    $edit_api = route('students.edit', $row);
                    $view_api = route('students.show', ['dhakila_number' => $row->dhakila_number]);
                    // $id_generate = route('student.generateID', ['dhakila_number' => $row->dhakila_number]);
                    $csrf = csrf_token();

                    // Start the action buttons section
                    $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>";

                    // Add Edit Button if the user has the 'student_edit' permission
                    if (auth()->user()->can('student_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit student details'>
                            <i class='ri-edit-box-fill'></i>
                        </a>";
                    }

                    // Add Delete Button if the user has the 'student_delete' permission
                    if (auth()->user()->can('student_delete')) {
                        $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' title='Delete student'>
                            <i class='ri-delete-bin-fill'></i>
                        </button>";
                    }

                    // Close the form tag
                    $action .= "</form>";

                    // Add additional buttons (View Attachments, View Details, Generate ID Card)
                    $action .= "<button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                        <i class='ri-eye-fill'></i>
                    </button>";

                    // View Details Button
                    $action .= "<a href='$view_api' class='btn btn-primary btn-sm m-1' title='View Student Details'>
                        <i class='ri-eye-fill'></i> View Details
                    </a>";

                    // Generate ID Card Button
    
                    return $action;
                })
                ->rawColumns(['created_at_read', 'actions']) // Render 'actions' column as raw HTML
                ->make(true);
        }

        // Fetch bibags for filters
        $bibags = Bibag::latest()->get();
        // dd($students);
        return view('admin.student.inactive', compact('students', 'bibags'));
    }


    public function create()
    {
        $bibags = Bibag::latest()->get();
        return view('admin.student.create', compact('bibags'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'form_number' => 'required|string|unique:students,form_number',
            'dhakila_number' => 'required|string|unique:students,dhakila_number',
            'dhakila_date' => 'required|date_format:d-m-Y',
            'student_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:15',
            'district' => 'nullable|string|max:255',
            'bibag_id' => 'required|exists:bibags,id',
            'gender' => 'nullable|in:male,female',
            'email' => 'nullable|email|max:255',  // email validation
            'emergency_contact' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'type' => 'required|in:Admission,Active,Deactive', // Validate type field
            'address' => 'nullable|string|max:255', // Validate address field

            
        ]);

        // Generate slug and admission ID
        $slug = $request->slug ?? Str::slug($request->student_name);
        $slug = $this->generateUniqueSlug($slug);
        $admission_id = $this->generateUniqueSku();

        $dhakilaDate = Carbon::createFromFormat('d-m-Y', $request->dhakila_date);

        // Create new student instance
        $student = new Student();

        // Save the student data
        $student->form_number = $request->form_number;
        $student->dhakila_number = $request->dhakila_number;
        $student->dhakila_date = $dhakilaDate;
        $student->student_name = $request->student_name;
        $student->father_name = $request->father_name;
        $student->mobile = $request->mobile;
        $student->district = $request->address;
        $student->bibag_id = $request->bibag_id;
        $student->type = $request->type;  // Store type
        $student->gender = $request->gender;
        $student->slug = $slug;
        $student->admission_id = $admission_id;

        // Save additional fields (email, emergency contact, image, etc.)
        if ($request->has('email')) {
            $student->email = $request->email;
        }

        if ($request->has('emergency_contact')) {
            $student->emergency_contact = $request->emergency_contact;
        }

        if ($request->has('date_of_birth')) {
            $student->date_of_birth = $request->date_of_birth;
        }

        // Image upload
        if ($request->has('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('image')->move(public_path('img/profile'), $fileNameToStore);
            $student->image = $fileNameToStore;
        }


        // Save the student record
        $student->save();


        // Create a new user associated with the student
        $user = new User();
        $user->name = $request->student_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->dhakila_number);
        $user->role = 'student';
        $user->student_dhakila_number = $request->dhakila_number;
        $user->save();


        // Handle file attachments (if any)
        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                StudentAttachment::create([
                    'student_id' => $student->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $fileNameToStore,
                    'file_type' => $extension,
                ]);
            }
        }
   

        // Redirect with a success message
        // return redirect()->route('students.index')->with('success', 'Admission created successfully!');
        return response()->json(['success' => "Admission Successful"]);
    }

    public function assign(int $studentId)
    {
        // Validate the incoming request
        $student = Student::findOrFail($studentId); // Find the student using the passed student_id

        // Get the service IDs from the student's services JSON column
        $serviceIds = json_decode($student->services);  // Get the selected service IDs from the JSON column

        // Loop through each selected service and add it to the assigned_fees table
        foreach ($serviceIds as $serviceId) {
            $service = OptionalService::findOrFail($serviceId);

            // Only add if the service is 'accepted'
            if ($service->status == 'accepted') {
                AssignedFee::create([
                    'student_id' => $student->id,
                    'fee_category_id' => null,  // You can set the fee category here if applicable
                    'optional_service_id' => $service->id,  // This is the service ID being assigned
                    'amount' => $service->amount,
                    'is_optional' => false,  // Mark as optional
                    'sreni_id' => $student->sreni_id,
                    'bibag_id' => $student->bibag_id,
                ]);
            }
        }

        // Return a success message
        return redirect()->route('assign-optional-service.create')->with('success', 'Services assigned successfully.');
    }




    private function assignFeesToStudent($student)
    {
        // Get the current year from dhakila_date
        $currentYear = Carbon::parse($student->dhakila_date)->year;

        // Get the FeeCategories based on the student's sreni_id and bibag_id
        $feeCategories = FeeCategory::where('sreni_id', $student->sreni_id)
            ->where('bibag_id', $student->bibag_id)
            ->get();

        // Loop through each FeeCategory and check if the fee has already been assigned for the current year
        foreach ($feeCategories as $feeCategory) {
            // Check if a fee is already assigned for the current year
            $assignedFee = AssignedFee::where('student_id', $student->id)
                ->where('fee_category_id', $feeCategory->id)
                ->whereYear('created_at', $currentYear)  // Ensure it's the current year
                ->first();

            // If no fee is assigned for the current year, assign it
            if (!$assignedFee) {
                AssignedFee::create([
                    'student_id' => $student->id,
                    'fee_category_id' => $feeCategory->id,
                    'amount' => $feeCategory->amount,
                    'sreni_id' => $feeCategory->sreni_id,
                    'bibag_id' => $feeCategory->bibag_id,
                    'is_optional' => false, // You can set this based on the business logic
                ]);
            }
        }
    }



    public function edit($id)
    {
        // Fetch the student data
        $student = Student::findOrFail($id);

        // Fetch the lists for Sreni, Bibag, and Sections
        $srenis = Sreni::all();
        $bibags = Bibag::all();
        $sections = SreniSection::latest()->get();

        // Fetch existing attachments
        $attachments = $student->attachments()->get(['id', 'file_path', 'file_name', 'file_type']);

        // Convert dhakila_date to Carbon instance and format it to 'd-m-Y'
        $dhakila_date = Carbon::parse($student->dhakila_date)->format('d-m-Y');
        $optionalServices = OptionalService::all();
        // Return the edit view with data, including the formatted dhakila_date
        return view('admin.student.edit', compact('student', 'srenis', 'attachments', 'bibags', 'sections', 'dhakila_date', 'optionalServices'));
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'form_number' => 'required|string|unique:students,form_number,' . $id,
            'dhakila_number' => 'required|string|unique:students,dhakila_number,' . $id,
            'dhakila_date' => 'required|date_format:d-m-Y',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'district' => 'nullable|string|max:255',
            'academic_session' => 'required|string|max:50',
            'sreni_id' => 'required|exists:srenis,id',
            'bibag_id' => 'required|exists:bibags,id',
            'roll_number' => 'nullable|integer',
            'gender' => 'nullable|in:male,female',
            'email' => 'nullable|email|max:255',  // email validation
            'emergency_contact' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // Max file size: 512KB
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048', // Max file size: 2MB
            'section_id' => 'nullable|exists:sreni_sections,id',
            'type' => 'required|in:Active,Deactive', // Validate type field
            'address' => 'nullable|string|max:255', // Validate address field

            'mother_name' => 'nullable|string|max:255', // Validate address field
            'mother_phone' => 'nullable|string|max:255', // Validate address field

            'services' => 'nullable|array', // Validate services field
        ]);

        // Fetch the student record
        $student = Student::findOrFail($id);

        // Generate a unique slug based on the student name
        $slug = $request->slug ?? Str::slug($request->student_name);
        $slug = $this->generateUniqueSlug($slug);

        // Convert Dhakila date format
        $dhakilaDate = Carbon::createFromFormat('d-m-Y', $request->dhakila_date);

        // Update student data
        $student->form_number = $request->form_number;
        $student->dhakila_number = $request->dhakila_number;
        $student->dhakila_date = $dhakilaDate;
        $student->student_name = $request->student_name;
        $student->father_name = $request->father_name;
        $student->mobile = $request->mobile;
        $student->district = $request->address;
        $student->academic_session = $request->academic_session;
        $student->sreni_id = $request->sreni_id;
        $student->bibag_id = $request->bibag_id;
        $student->roll_number = $request->roll_number;
        $student->type = $request->type;  // Store type
        $student->gender = $request->gender;
        $student->slug = $slug;
        $student->section_id = $request->section_id;

        $student->mother_name = $request->mother_name;
        $student->mother_phone = $request->mother_phone;

        if ($request->has('email')) {
            $student->email = $request->email;
        }

        if ($request->has('emergency_contact')) {
            $student->emergency_contact = $request->emergency_contact;
        }

        if ($request->has('date_of_birth')) {
            $student->date_of_birth = $request->date_of_birth;
        }

        // Handle image upload
        if ($request->has('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('image')->move(public_path('img/profile'), $fileNameToStore);
            $student->image = $fileNameToStore;
        }
        // Update services
        if ($request->has('services')) {
            $student->services = json_encode($request->services); // Store selected service IDs as JSON
        }

        // Save the updated student record
        $student->save();

        if ($request->has('services') && count($request->services) > 0) {
            // Detach all previous services
            $student->optionalServices()->detach();

            // Attach the new selected services
            $student->optionalServices()->attach($request->services); // Attach the selected services to student_service table
        } else {
            // If no services are selected, remove all services from student_service table
            $student->optionalServices()->detach();  // Detach all services if none are selected
        }

        //     // Handle file attachments (if any)
        //     if ($request->hasFile('attachments')) {
        //         $files = $request->file('attachments');
        //         foreach ($files as $file) {
        //             $filenameWithExt = $file->getClientOriginalName();
        //             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //             $extension = $file->getClientOriginalExtension();
        //             $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        //             $file->move(public_path('assets/attachements'), $fileNameToStore);

        //             // Save the attachment information in the database
        //             StudentAttachment::create([
        //                 'student_id' => $student->id,
        //                 'file_path' => $fileNameToStore,
        //                 'file_name' => $fileNameToStore,
        //                 'file_type' => $extension,
        //             ]);
        //         }
        //     }
        //     if ($request->hasFile('attachments')) {
        //         $files = $request->file('attachments');
        //         foreach ($files as $file) {
        //             $filenameWithExt = $file->getClientOriginalName();
        //             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //             $extension = $file->getClientOriginalExtension();
        //             $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        //             $file->move(public_path('assets/attachements'), $fileNameToStore);

        //             StudentAttachment::create([
        //                 'student_id' => $student->id,
        //                 'file_path' => $fileNameToStore,
        //                 'file_name' => $fileNameToStore,
        //                 'file_type' => $extension,
        //             ]);
        //         }
        //     }
        //     $this->assignFeesToStudent($student);

        //     // Redirect with success message
        //     return redirect()->route('students.index')->with('success', 'Student updated successfully!');
        // }
        // === Remove selected attachments ===
        if ($request->has('delete_attachments')) {
            foreach ($request->delete_attachments as $attachmentId) {
                $attachment = StudentAttachment::find($attachmentId);
                if ($attachment) {
                    $filePath = public_path('assets/attachements/' . $attachment->file_path);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    $attachment->delete();
                }
            }
        }

        // === Handle new file attachments (only once) ===
        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                StudentAttachment::create([
                    'student_id' => $student->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $fileNameToStore,
                    'file_type' => $extension,
                ]);
            }
        }

        $this->assignFeesToStudent($student);

        // === Ajax হলে JSON রেসপন্স দিন ===
        if ($request->ajax()) {
            return response()->json(['success' => 'Student updated successfully!']);
        }

        // নরমাল রিকোয়েস্ট হলে রিডাইরেক্ট
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }





    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', "Student Deleted Successfully");
    }
    private function generateUniqueSku()
    {
        do {
            // Generate a random SKU in the desired format
            $sku = 'admission-' . strtoupper(Str::random(8));
        } while (Student::where('admission_id', $sku)->exists());

        return $sku;
    }

    // Generate a unique slug based on the given slug, ignoring the specified product ID if provided.
    private function generateUniqueSlug($slug, $ignoreId = null)
    {
        // Add the '-{count}' suffix only if the slug already exists in the database.
        $originalSlug = $slug;
        $count = 1;

        while (
            Student::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    return $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = "{$originalSlug}-" . $count++;
        }

        return $slug;
    }

    public function getAttachments(Student $student)
    {
        $attachments = $student->attachments()->get(['file_path', 'file_name', 'file_type']);

        // Generate URLs for the attachments
        $attachments = $attachments->map(function ($attachment) {
            return [
                'url' => asset('assets/attachements/' . $attachment->file_path),
                'name' => $attachment->file_name,
                'file_type' => $attachment->file_type
            ];
        });

        return response()->json(['attachments' => $attachments]);
    }


    public function exportExcel(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'bibag_id' => 'nullable|integer',
            'sreni_id' => 'nullable|integer',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $bibagId = $request->input('bibag_id');
        $sreniId = $request->input('sreni_id');

        // Format for the filename to include date range
        $filename = 'students';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate . '_to_' . $toDate;
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate;
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate;
        }
        $filename .= '.xlsx';

        return Excel::download(new StudentsExport($fromDate, $toDate, $bibagId, $sreniId), $filename);
    }

    // Export to PDF
    public function exportPDF(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'bibag_id' => 'nullable|integer',
            'sreni_id' => 'nullable|integer',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $bibagId = $request->input('bibag_id');
        $sreniId = $request->input('sreni_id');

        // Build the query with necessary joins and filters
        $query = Student::with('attachments')
            ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
            ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
            ->select('students.*', 'srenis.name as sreni_name', 'bibags.name as bibag_name')
            ->latest();

        // Apply date filters
        if ($fromDate && $toDate) {
            $query->whereDate('students.created_at', '>=', $fromDate)
                ->whereDate('students.created_at', '<=', $toDate);
        } elseif ($fromDate) {
            $query->whereDate('students.created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('students.created_at', '<=', $toDate);
        }

        if ($bibagId) {
            $query->where('bibags.id', $bibagId);
        }

        if ($sreniId) {
            $query->where('srenis.id', $sreniId);
        }

        $students = $query->get();


        // Format for the filename to include date range
        $filename = 'students';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate . '_to_' . $toDate;
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate;
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate;
        }
        $filename .= '.pdf';


        $pdf = Pdf::loadView('admin.student.export_pdf', [
            'students' => $students,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }




    public function show($dhakila_number)
    {
        // Fetch the student based on dhakila_number instead of id
        $student = Student::where('dhakila_number', $dhakila_number)->firstOrFail();

        // Get the payments and attendances for this student
        $payments = $student->payments;
        $attendances = $student->attendances ?? collect([]);

        // dd($attendances);

        // Get the attachments for this student
        $attachments = $student->attachments;
        $activeTab = 'basic-info';
        return view('admin.student.show', compact('student', 'payments', 'activeTab', 'attendances', 'attachments'));
    }

    public function getPayments($dhakila_number)
    {
        $payments = Payment::where('dhakila_number', $dhakila_number)
            ->join('purposes', 'payments.purpose_id', '=', 'purposes.id')
            ->select('payments.id', 'payments.reciept_no', 'payments.date', 'payments.amount', 'purposes.purpose_name')
            ->get();
        // $payments->transform(function ($payment, $key) {
        //     $payment->DT_RowIndex = $key + 1;
        //     return $payment;
        // });
        return DataTables::of($payments)
            ->addIndexColumn()  // Adds a serial number column
            ->make(true);

        Log::info($payments);

        // JSON আকারে রিটার্ন
        return response()->json($payments);
    }
    public function getAttendances($id)
    {
        $attendances = Attendance::join('students', 'attendances.student_id', '=', 'students.id')
            ->join('attendance_types', 'attendances.attendance_type_id', '=', 'attendance_types.id')
            ->where('attendances.student_id', $id)  // এখানে 'attendances.id' দিয়ে Attendance ID ফিল্টার করা হচ্ছে
            ->select('attendances.student_id', 'attendances.date', 'attendance_types.name as attendance_type', 'attendance_types.color', 'attendances.remark')
            ->get();
        // Add DT_RowIndex manually
        // $attendances->transform(function ($attendance, $key) {
        //     $attendance->DT_RowIndex = $key + 1; // Adds the row index starting from 1
        //     return $attendance;
        // });
        return DataTables::of($attendances)
            ->addIndexColumn()
            ->editColumn('attendance_type', function ($attendance) {
                return "<span style='color: {$attendance->color}; font-weight: bold;'>{$attendance->attendance_type}</span>";
            })
            ->rawColumns(['attendance_type'])
            ->make(true);

        Log::info($attendances);
        return response()->json($attendances);
    }




    public function studentProfile()
    {
        return view('admin.student.profile');
    }

    public function searchStudent(Request $request)
    {
        $dhakilaNumber = $request->input('dhakila_number');
        $student = Student::where('dhakila_number', $dhakilaNumber)->first();

        if (!$student) {
            return back()->with('error', 'Student not found with this Dhakila Number.');
        }

        $payments = $student->payments;
        $attendances = $student->attendances ?? collect([]);
        $attachments = $student->attachments;
        $activeTab = 'basic-info';


        return view('admin.student.profile', compact('student', 'payments', 'attendances', 'attachments', 'activeTab'));
    }

    public function generateID($dhakila_number)
    {
        // Fetch the student based on dhakila_number instead of id
        $student = Student::where('dhakila_number', $dhakila_number)->firstOrFail();

        return view('admin.student.id_card', compact('student', ));
    }


    // Show the search and ID card generation page
    public function searchIdCard()
    {
        return view('admin.student.search_id_card');
    }

    // ekhane indivisual vabe dekhay 
    // public function dueStudents(Request $request)
    // {
    //     // Get all students with their due fee assignments
    //     $students = Student::with(['assignedFees' => function($query) {
    //         // Apply the 'due' scope to only get due fees (fees with an amount > 0)
    //         $query->due();
    //     }])
    //     ->join('srenis', 'students.sreni_id', '=', 'srenis.id')
    //     ->join('bibags', 'students.bibag_id', '=', 'bibags.id')
    //     ->select('students.id', 'students.student_name', 'srenis.name as sreni_name', 'bibags.name as bibag_name')
    //     ->get();

    //     return view('admin.student.due', compact('students'));
    // }
    // StudentController.php
    public function dueStudents(Request $request)
    {
        // Get the filter parameters from the request
        $sreniId = $request->input('sreni_id');
        $bibagId = $request->input('bibag_id');
        $searchTerm = $request->input('search.value', ''); // For search functionality

        // Query to fetch the students based on filters
        $studentsQuery = Student::with(['assignedFees.feeCategory'])
            ->join('srenis', 'students.sreni_id', '=', 'srenis.id')
            ->join('bibags', 'students.bibag_id', '=', 'bibags.id')
            ->select('students.id', 'students.student_name', 'srenis.name as sreni_name', 'bibags.name as bibag_name', 'students.dhakila_number')
            ->when($sreniId, function ($query) use ($sreniId) {
                return $query->where('students.sreni_id', $sreniId);
            })
            ->when($bibagId, function ($query) use ($bibagId) {
                return $query->where('students.bibag_id', $bibagId);
            })
            ->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where('students.student_name', 'like', "%{$searchTerm}%")
                    ->orWhere('students.dhakila_number', 'like', "%{$searchTerm}%");
            });

        // Fetching data for Sreni and Bibag for filters
        $srenis = Sreni::all();
        $bibags = Bibag::all();

        // Fetch all students (without pagination, as DataTables will handle it)
        $students = $studentsQuery->get();

        // Calculate total due fee for each student
        foreach ($students as $student) {
            $totalDue = 0;
            foreach ($student->assignedFees as $fee) {
                $totalDue += $fee->amount;
            }
            $student->total_due = $totalDue; // Store total due fee

            // Fetch payments made by the student based on the dhakila_number
            $payments = Payment::where('dhakila_number', $student->dhakila_number)->sum('amount');

            // Subtract the total payments from the total due fee
            $student->total_due_after_payment = $student->total_due - $payments;
        }

        // If it's an AJAX request, return the DataTables response
        if ($request->ajax()) {
            // Return DataTables JSON response
            return DataTables::of($students)
                ->addIndexColumn()
                ->addColumn('total_due', function ($row) {
                    return $row->total_due;  // Add the total due amount
                })
                ->addColumn('total_due_after_payment', function ($row) {
                    return $row->total_due_after_payment;  // Add the total due after payment amount
                })
                ->addColumn('actions', function ($row) {
                    return '<button class="btn btn-info btn-sm view-details" data-id="' . $row->id . '">View Details</button>';
                })
                ->rawColumns(['actions'])  // Allow raw HTML for the actions column
                ->make(true);  // Return the DataTables JSON response
        }

        // Return view if not AJAX request
        return view('admin.student.due', compact('students', 'bibags', 'srenis'));
    }

    public function dueStudentDetails($id)
    {
        // Get student data along with assigned fees
        $student = Student::with(['assignedFees.feeCategory'])
            ->join('srenis', 'students.sreni_id', '=', 'srenis.id')
            ->join('bibags', 'students.bibag_id', '=', 'bibags.id')
            ->select('students.id', 'students.student_name', 'srenis.name as sreni_name', 'bibags.name as bibag_name', 'students.dhakila_number')
            ->where('students.id', $id)
            ->first();

        // Check if student is found
        if (!$student) {
            return redirect()->route('students.due')->with('error', 'Student not found');
        }

        // Calculate total due fee for the student
        $totalDue = 0;
        foreach ($student->assignedFees as $fee) {
            $totalDue += $fee->amount;
        }
        $student->total_due = $totalDue; // Store total due fee

        // Fetch payments made by the student based on the dhakila_number
        $payments = Payment::where('dhakila_number', $student->dhakila_number)->sum('amount');

        // Subtract the total payments from the total due fee
        $student->total_due_after_payment = $student->total_due - $payments;

        // Return student details view
        return view('admin.student.view_due', compact('student', 'payments'));
    }

    public function admitCard($exam_id, $student_id)
    {
        $student = Student::findOrFail($student_id);
        $exam = Exam::findOrFail($exam_id);

        // এখানে আপনি চাইলে অ্যাডমিট কার্ডের জন্য আলাদা ভিউ বানাতে পারেন
        // উদাহরণ:
        return view('admin.student.admit_card', compact('student', 'exam'));
    }



}
