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



    public function edit($id)
    {
        // Fetch the student data
        $student = Student::findOrFail($id);

        // Fetch the lists for Sreni, Bibag, and Sections
        $srenis = Sreni::all();
        $bibags = Bibag::all();

        // Fetch existing attachments
        $attachments = $student->attachments()->get(['id', 'file_path', 'file_name', 'file_type']);

        // Convert dhakila_date to Carbon instance and format it to 'd-m-Y'
        $dhakila_date = Carbon::parse($student->dhakila_date)->format('d-m-Y');
        // Return the edit view with data, including the formatted dhakila_date
        return view('admin.student.edit', compact('student', 'srenis', 'attachments', 'bibags' , 'dhakila_date'));
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
            'bibag_id' => 'required|exists:bibags,id',
            'gender' => 'nullable|in:male,female',
            'email' => 'nullable|email|max:255',  // email validation
            'emergency_contact' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // Max file size: 512KB
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048', // Max file size: 2MB
            'section_id' => 'nullable|exists:sreni_sections,id',
            'type' => 'required|in:Active,Deactive', // Validate type field
            'address' => 'nullable|string|max:255', // Validate address field

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
        $student->sreni_id = $request->sreni_id;
        $student->bibag_id = $request->bibag_id;
        $student->type = $request->type;  // Store type
        $student->gender = $request->gender;
        $student->slug = $slug;



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
       

        // Save the updated student record
        $student->save();

       
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

   
    public function admitCard($exam_id, $student_id)
    {
        $student = Student::findOrFail($student_id);
        $exam = Exam::findOrFail($exam_id);

        // এখানে আপনি চাইলে অ্যাডমিট কার্ডের জন্য আলাদা ভিউ বানাতে পারেন
        // উদাহরণ:
        return view('admin.student.admit_card', compact('student', 'exam'));
    }



}
