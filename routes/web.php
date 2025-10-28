<?php

use App\Http\Controllers\Admin\BibagController;
use App\Http\Controllers\Admin\ExpenseHeadController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SreniController;
use App\Http\Controllers\Admin\StudentController;

use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PurposeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceTypeController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AttachmentTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;



use App\Models\Notice;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Bibag;
use App\Models\Sreni;
use App\Http\Controllers\ComplaintController;
use App\Models\Attachment;
use App\Models\Course;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SreniSectionController;

use App\Http\Controllers\Admin\FeeCategoryController;
use App\Http\Controllers\Admin\AssignedFeeController;
use App\Http\Controllers\Admin\OptionalServiceController;

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $noticeOne = Notice::latest()->first();  // Fetch the latest notice
    $teachers = Teacher::where('staff_type', 'teacher')->get();

    $notices = Notice::latest()->paginate(15);

    $courses = Course::with(['teachers', 'topics'])->latest()->get();


    // Map notices into the event format for the calendar
    $events = $notices->map(function ($notice) {
        $date = explode('-', $notice->date); // Assuming 'date' is stored in 'YYYY-MM-DD' format
        return [
            'id' => $notice->id, // Include the ID for clickable links
            'occasion' => $notice->section_title, // Title of the notice
            'year' => (int) $date[0],
            'month' => (int) $date[1],
            'day' => (int) $date[2],
            'cancelled' => false, // Add your cancellation logic if necessary
        ];
    });

    return view('frontend/home', compact('notices', 'noticeOne', 'teachers', 'events', 'courses'));
});


Route::prefix('panel')->group(function () {
    Auth::routes();
});


Route::prefix('panel')->middleware(['auth', 'checkRole:admin'])->group(function () {


    Route::resource('fee-categories', FeeCategoryController::class);
    Route::resource('assigned-fees', AssignedFeeController::class);

    Route::resource('optional-services', OptionalServiceController::class);
    Route::get('/assign-optional-services', [OptionalServiceController::class, 'assignCreate'])->name('assign-optional-service.create');
    Route::post('/assign-optional-services', [OptionalServiceController::class, 'assign'])->name('optional-service.assign');

    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    // Route::get('studentD', [HomeController::class, 'studentD'])->name('studentD');

    Route::get('/get-subjects/{sreniId}', [LessonController::class, 'getSubjectsBySreni'])->name('get.subjects.by.sreni');


    Route::middleware(['permission:sms_add'])->get('/sms-form', [SmsController::class, 'smsForm'])->name('sms.form');
    Route::middleware(['permission:sms_add'])->post('/send-sms', [SmsController::class, 'sendSmsToStudent'])->name('sms.send');


    // Route::resource('subjects', SubjectController::class);
    Route::middleware(['permission:subject_view'])->get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::middleware(['permission:subject_add'])->get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::middleware(['permission:subject_add'])->post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::middleware(['permission:subject_edit'])->get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::middleware(['permission:subject_edit'])->put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::middleware(['permission:subject_delete'])->delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

    // Route::resource('lessons', LessonController::class);
    Route::middleware(['permission:lesson_view'])->get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
    Route::middleware(['permission:lesson_add'])->get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::middleware(['permission:lesson_add'])->post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::middleware(['permission:lesson_edit'])->get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::middleware(['permission:lesson_edit'])->put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
    Route::middleware(['permission:lesson_delete'])->delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');



    // Route for exams CRUD operations
    // Route::resource('exams', ExamController::class);
    Route::middleware(['permission:exam_view'])->get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::middleware(['permission:exam_add'])->get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::middleware(['permission:exam_add'])->post('/exams', [ExamController::class, 'store'])->name('exams.store');
    Route::middleware(['permission:exam_edit'])->get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');
    Route::middleware(['permission:exam_edit'])->put('/exams/{exam}', [ExamController::class, 'update'])->name('exams.update');
    Route::middleware(['permission:exam_delete'])->delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');

    Route::get('/filter-subjects', [ExamController::class, 'getSubjectsByBibagAndSreni'])->name('filter.subjects');

    // web.php 
    // Route::get('/results/export/excel', [ResultController::class, 'exportExcel'])->name('results.export.excel');
    Route::get('/results/export-pdf', [ResultController::class, 'exportPDF'])->name('results.export.pdf');
    Route::get('/student/marksheet', [ResultController::class, 'studentMarksheet'])->name('student.marksheet');
    Route::get('/student/marksheet/download', [ResultController::class, 'downloadMarksheet'])->name('student.marksheet.download');
    // Route::post('/results/store/{examId}', [ResultController::class, 'storeResults'])->name('results.store');
    // Route::get('/results/{studentId}/{examId}', [ResultController::class, 'showResults'])->name('results.show');
    Route::resource('results', ResultController::class);
    Route::get('results/view', [ResultController::class, 'show'])->name('results.view');
    // Route::get('results/filter', [ResultController::class, 'index'])->name('results.index');

    // Route::middleware(['permission:result_view'])->get('exams/{exam_id}/add-marks', [ExamController::class, 'addMarksForm'])->name('exams.addMarksForm');
    // Route::middleware(['permission:result_view'])->post('exams/{exam_id}/add-marks', [ExamController::class, 'addMarks'])->name('exams.addMarks');

    Route::get('/student/{dhakila_number}/generate-id', [StudentController::class, 'generateID'])->name('student.generateID');

    // // Permission Route 
    // Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    // Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    // Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    // Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    // Route::put('/permissions/{id}/update', [PermissionController::class, 'update'])->name('permissions.update');
    // Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // // Role Route
    // Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    // Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    // Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    // Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    // Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    // Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Role Routes
    Route::middleware(['permission:role_view'])->get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::middleware(['permission:role_add'])->get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::middleware(['permission:role_add'])->post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::middleware(['permission:role_edit'])->get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::middleware(['permission:role_edit'])->put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::middleware(['permission:role_delete'])->delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Permission Routes
    Route::middleware(['permission:permission_view'])->get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::middleware(['permission:permission_add'])->get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::middleware(['permission:permission_add'])->post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::middleware(['permission:permission_edit'])->get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::middleware(['permission:permission_edit'])->put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::middleware(['permission:permission_delete'])->delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // User Routes
    Route::middleware(['permission:user_view'])->get('/users', [UserController::class, 'index'])->name('users.index');
    Route::middleware(['permission:user_add'])->get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::middleware(['permission:user_add'])->post('/users', [UserController::class, 'store'])->name('users.store');
    Route::middleware(['permission:user_edit'])->get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::middleware(['permission:user_edit'])->put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::middleware(['permission:user_delete'])->delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/check-student-dakhila-number', [UserController::class, 'checkStudentDakhilaNumber'])->name('checkStudentDakhilaNumber');





    // 🟢 Course Admin Routes with Spatie Permissions
    Route::middleware(['permission:course_view'])->get('/courses', [CourseController::class, 'index'])->name('courses.index'); // Show all courses
    Route::middleware(['permission:course_add'])->get('/courses/create', [CourseController::class, 'create'])->name('courses.create'); // Show form to add a new course
    Route::middleware(['permission:course_add'])->post('/courses/store', [CourseController::class, 'store'])->name('courses.store'); // Store new course
    Route::middleware(['permission:course_edit'])->get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit'); // Show form to edit course
    Route::middleware(['permission:course_edit'])->put('/courses/{course}/update', [CourseController::class, 'update'])->name('courses.update'); // Update course
    Route::middleware(['permission:course_delete'])->delete('/courses/{course}/destroy', [CourseController::class, 'destroy'])->name('courses.destroy'); // Delete course





    // Route::get('/get-phone-numbers', function() {
    //     $phoneNumbers = Student::pluck('mobile')->toArray();

    //     return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    // })->name('sms.getPhoneNumbers');



    // // Class One student number 
    // Route::get('/get-phone-numbers3', function() {
    //     $sreniId = 3;  // Fixed sreni_id for class 3

    //     $phoneNumbers = Student::where('sreni_id', $sreniId)
    //                             ->pluck('mobile')
    //                             ->toArray();

    //     return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    // })->name('sms.getPhoneNumbersclass3');
    // Route to get all student phone numbers


    Route::get('/panel/sms/get-sections', [SmsController::class, 'getSectionsByBibagSreni'])->name('sms.getSectionsByBibagSreni');
    Route::get('/panel/sms/get-numbers-by-bibag-sreni-section', [SmsController::class, 'getNumbersByBibagSreniSection'])->name('sms.getNumbersByBibagSreniSection');





















    // Route to get all student phone numbers
    Route::get('/get-phone-numbersall', function () {
        $phoneNumbers = Student::pluck('mobile')->toArray();
        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersall');

    // Route to get phone numbers for Class One (sreni_id = 1 for Class One)
    Route::get('/get-phone-numbers3', function () {
        $sreniId = 3;  // Fixed sreni_id for Class One

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass3');

    // Route to get phone numbers for Class One students (sreni_id = 4 for Class One)
    Route::get('/get-phone-numbers4', function () {
        $sreniId = 4;  // Fixed sreni_id for Class One

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass4');

    // Route to get phone numbers for Class One students (sreni_id = 5 for Class One)
    Route::get('/get-phone-numbers5', function () {
        $sreniId = 5;  // Fixed sreni_id for Class One

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass5');

    // Route to get phone numbers for Class 6 students
    Route::get('/get-phone-numbers6', function () {
        $sreniId = 6;  // Fixed sreni_id for Class 6

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass6');

    // Route to get phone numbers for Class 7 students
    Route::get('/get-phone-numbers7', function () {
        $sreniId = 7;  // Fixed sreni_id for Class 7

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass7');

    // Route to get phone numbers for Class 8 students
    Route::get('/get-phone-numbers8', function () {
        $sreniId = 8;  // Fixed sreni_id for Class 8

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass8');

    // Route to get phone numbers for Class 9 students
    Route::get('/get-phone-numbers9', function () {
        $sreniId = 9;  // Fixed sreni_id for Class 9

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass9');

    // Route to get phone numbers for Class 10 students
    Route::get('/get-phone-numbers10', function () {
        $sreniId = 10;  // Fixed sreni_id for Class 10

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass10');

    // Route to get phone numbers for Class 11 students
    Route::get('/get-phone-numbers11', function () {
        $sreniId = 11;  // Fixed sreni_id for Class 11

        $phoneNumbers = Student::where('sreni_id', $sreniId)
            ->pluck('mobile')
            ->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersclass11');








    Route::get('/get-phone-numbers-teachers', function () {
        $phoneNumbers = Teacher::pluck('phone_number')->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbersTeachers');


    // New route to fetch combined phone numbers from both tables
    Route::get('/get-all-phone-numbers', function () {
        // Merge both student and teacher phone numbers and remove duplicates
        $studentNumbers = Student::pluck('mobile')->toArray();
        $teacherNumbers = Teacher::pluck('phone_number')->toArray();

        // Combine and remove duplicate phone numbers
        $allNumbers = array_unique(array_merge($studentNumbers, $teacherNumbers));

        return response()->json(['success' => true, 'phone_numbers' => $allNumbers]);
    })->name('sms.getAllPhoneNumbers');





    Route::get('/get-student-details/{dhakila_number}', function ($dhakila_number) {
        $student = Student::where('dhakila_number', $dhakila_number)->first();

        if ($student) {
            return response()->json([
                'student_name' => $student->student_name,
                'district' => $student->district,
                'bibag_id' => $student->bibag_id,
                'sreni_id' => $student->sreni_id,
                'mobile' => $student->mobile,
            ]);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    });

    Route::get('/get-phone-numbers', function (Request $request) {
        $sreniId = $request->input('sreni_id');
        $sectionId = $request->input('section_id');

        $query = Student::query();

        if ($sreniId) {
            $query->where('sreni_id', $sreniId);
        }
        if ($sectionId) {
            $query->where('section_id', $sectionId);
        }

        $phoneNumbers = $query->pluck('mobile')->toArray();

        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    })->name('sms.getPhoneNumbers');




    // Route::resource('students', StudentController::class);
    // Route::resource('srenis', SreniController::class);
    // Route::resource('expense_heads', ExpenseHeadController::class);
    // Route::resource('purposes', PurposeController::class);
    // Route::resource('expenses', ExpenseController::class);
    // Route::resource('payments', PaymentController::class);
    // Route::resource('bibags', BibagController::class);


    // 🟢 Sreni (Class) Management Routes with Spatie Permissions
    Route::middleware(['permission:sreni_view'])->get('/srenis', [SreniController::class, 'index'])->name('srenis.index'); // View Sreni list
    Route::middleware(['permission:sreni_add'])->get('/srenis/create', [SreniController::class, 'create'])->name('srenis.create'); // Show form to create Sreni
    Route::middleware(['permission:sreni_add'])->post('/srenis/store', [SreniController::class, 'store'])->name('srenis.store'); // Store Sreni data
    Route::middleware(['permission:sreni_edit'])->get('/srenis/{id}/edit', [SreniController::class, 'edit'])->name('srenis.edit'); // Show form to edit Sreni
    Route::middleware(['permission:sreni_edit'])->put('/srenis/{id}/update', [SreniController::class, 'update'])->name('srenis.update'); // Update Sreni data
    Route::middleware(['permission:sreni_delete'])->delete('/srenis/{id}/destroy', [SreniController::class, 'destroy'])->name('srenis.destroy'); // Delete Sreni

    // 🟢 Expense Head Management Routes with Spatie Permissions
    Route::middleware(['permission:expense_head_view'])->get('/expense_heads', [ExpenseHeadController::class, 'index'])->name('expense_heads.index'); // View Expense Head list
    Route::middleware(['permission:expense_head_add'])->get('/expense_heads/create', [ExpenseHeadController::class, 'create'])->name('expense_heads.create'); // Show form to create Expense Head
    Route::middleware(['permission:expense_head_add'])->post('/expense_heads/store', [ExpenseHeadController::class, 'store'])->name('expense_heads.store'); // Store Expense Head data
    Route::middleware(['permission:expense_head_edit'])->get('/expense_heads/{id}/edit', [ExpenseHeadController::class, 'edit'])->name('expense_heads.edit'); // Show form to edit Expense Head
    Route::middleware(['permission:expense_head_edit'])->put('/expense_heads/{id}/update', [ExpenseHeadController::class, 'update'])->name('expense_heads.update'); // Update Expense Head data
    Route::middleware(['permission:expense_head_delete'])->delete('/expense_heads/{id}/destroy', [ExpenseHeadController::class, 'destroy'])->name('expense_heads.destroy'); // Delete Expense Head



    // 🟢 Purpose Management Routes with Spatie Permissions
    Route::middleware(['permission:purpose_view'])->get('/purposes', [PurposeController::class, 'index'])->name('purposes.index'); // View Purpose list
    Route::middleware(['permission:purpose_add'])->get('/purposes/create', [PurposeController::class, 'create'])->name('purposes.create'); // Show form to create Purpose
    Route::middleware(['permission:purpose_add'])->post('/purposes/store', [PurposeController::class, 'store'])->name('purposes.store'); // Store Purpose data
    Route::middleware(['permission:purpose_edit'])->get('/purposes/{id}/edit', [PurposeController::class, 'edit'])->name('purposes.edit'); // Show form to edit Purpose
    Route::middleware(['permission:purpose_edit'])->put('/purposes/{id}/update', [PurposeController::class, 'update'])->name('purposes.update'); // Update Purpose data
    Route::middleware(['permission:purpose_delete'])->delete('/purposes/{id}/destroy', [PurposeController::class, 'destroy'])->name('purposes.destroy'); // Delete Purpose


    // 🟢 Expense Management Routes with Spatie Permissions
    // Route::middleware(['permission:expense_view|expense_add'])->get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index'); // View Expense list
    // 🟢 Expense Management Routes with Spatie Permissions
    Route::middleware(['permission:expense_add|expense_view'])->get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index'); // View Expense list

    Route::middleware(['permission:expense_add'])->get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create'); // Show form to create Expense
    Route::middleware(['permission:expense_add'])->post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store'); // Store Expense data
    Route::middleware(['permission:expense_edit'])->get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit'); // Show form to edit Expense
    Route::middleware(['permission:expense_edit'])->put('/expenses/{expense}/update', [ExpenseController::class, 'update'])->name('expenses.update'); // Update Expense data
    Route::middleware(['permission:expense_delete'])->delete('/expenses/{id}/destroy', [ExpenseController::class, 'destroy'])->name('expenses.destroy'); // Delete Expense
    Route::get("expense/report", [ExpenseController::class, 'export_report'])->name('expense.report');

    // 🟢 Payment Management Routes with Spatie Permissions
    Route::middleware(['permission:payment_view|payment_add'])->get('/payments', [PaymentController::class, 'index'])->name('payments.index'); // View Payment list
    Route::middleware(['permission:payment_add'])->get('/payments/create', [PaymentController::class, 'create'])->name('payments.create'); // Show form to create Payment
    Route::middleware(['permission:payment_add'])->post('/payments/store', [PaymentController::class, 'store'])->name('payments.store'); // Store Payment data
    Route::middleware(['permission:payment_edit'])->get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit'); // Show form to edit Payment
    Route::middleware(['permission:payment_edit'])->put('/payments/{payment}/update', [PaymentController::class, 'update'])->name('payments.update');
    Route::middleware(['permission:payment_delete'])->delete('/payments/{id}/destroy', [PaymentController::class, 'destroy'])->name('payments.destroy'); // Delete Payment


    // 🟢 Bibag Management Routes with Spatie Permissions
    Route::middleware(['permission:bibag_view'])->get('/bibags', [BibagController::class, 'index'])->name('bibags.index'); // View Bibag list
    Route::middleware(['permission:bibag_add'])->get('/bibags/create', [BibagController::class, 'create'])->name('bibags.create'); // Show form to create Bibag
    Route::middleware(['permission:bibag_add'])->post('/bibags/store', [BibagController::class, 'store'])->name('bibags.store'); // Store Bibag data
    Route::middleware(['permission:bibag_edit'])->get('/bibags/{id}/edit', [BibagController::class, 'edit'])->name('bibags.edit'); // Show form to edit Bibag
    Route::middleware(['permission:bibag_edit'])->put('/bibags/{id}/update', [BibagController::class, 'update'])->name('bibags.update'); // Update Bibag data
    Route::middleware(['permission:bibag_delete'])->delete('/bibags/{id}/destroy', [BibagController::class, 'destroy'])->name('bibags.destroy'); // Delete Bibag



    Route::get("payments/report", [PaymentController::class, 'payment_report'])->name('payments.report');





    Route::get('students/{student}/attachments', [StudentController::class, 'getAttachments'])->name('students.attachments');
    Route::get('expenses/{expense}/attachments', [ExpenseController::class, 'getAttachments'])->name('expenses.attachments');
    Route::get('payments/{payment}/attachments', [PaymentController::class, 'getAttachments'])->name('payments.attachments');

    // New export routes
    Route::get('students/export/excel', [StudentController::class, 'exportExcel'])->name('students.export.excel');
    Route::get('students/export/pdf', [StudentController::class, 'exportPDF'])->name('students.export.pdf');

    Route::get('expenses/export/excel', [ExpenseController::class, 'exportExcel'])->name('expenses.export.excel');
    Route::get('expenses/export/pdf', [ExpenseController::class, 'exportPDF'])->name('expenses.export.pdf');


    Route::get('payments/export/excel', [PaymentController::class, 'exportExcel'])->name('payments.export.excel');
    Route::get('payments/export/pdf', [PaymentController::class, 'exportPDF'])->name('payments.export.pdf');


    Route::middleware(['permission:setting_view'])->resource('setting', SettingController::class);

    Route::post('/change-password', [SettingController::class, 'changePassword'])->name('password.change');



    Route::middleware(['permission:notice_view'])->get('notices/list', [NoticeController::class, 'index'])->name('notices.list');
    Route::middleware(['permission:notice_add'])->get('notices/add', [NoticeController::class, 'create'])->name('notices.add');
    Route::middleware(['permission:notice_add'])->post('notices/store', [NoticeController::class, 'store'])->name('notices.store');
    Route::middleware(['permission:notice_edit'])->get('notices/{id}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
    Route::middleware(['permission:notice_edit'])->put('notices/{id}/update', [NoticeController::class, 'update'])->name('notices.update');
    Route::middleware(['permission:notice_delete'])->delete('notices/{id}', [NoticeController::class, 'destroy'])->name('notices.delete');





    // 🟢 Gallery Admin Routes with Spatie Permissions
    Route::middleware(['permission:gallery_view'])->get('/gallery/list', [GalleryController::class, 'index'])->name('gallery.list'); // Show all gallery items
    Route::middleware(['permission:gallery_add'])->get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create'); // Show form to add a new gallery item
    Route::middleware(['permission:gallery_add'])->post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store'); // Store new gallery item
    Route::middleware(['permission:gallery_edit'])->get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit'); // Show form to edit gallery item
    Route::middleware(['permission:gallery_edit'])->put('/gallery/{id}/update', [GalleryController::class, 'update'])->name('gallery.update'); // Update gallery item
    Route::middleware(['permission:gallery_delete'])->delete('/gallery/{id}/destroy', [GalleryController::class, 'destroy'])->name('gallery.destroy'); // Delete gallery item


    // 🟢 Teacher Admin Routes with Spatie Permissions
    Route::middleware(['permission:teacher_view'])->get('/teacher/list', [TeacherController::class, 'index'])->name('teacher.list'); // Show all teacher items
    Route::middleware(['permission:teacher_add'])->get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create'); // Show form to add a new teacher
    Route::middleware(['permission:teacher_add'])->post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store'); // Store new teacher
    Route::middleware(['permission:teacher_edit'])->get('/teacher/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit'); // Show form to edit teacher
    Route::middleware(['permission:teacher_edit'])->put('/teacher/{id}/update', [TeacherController::class, 'update'])->name('teacher.update'); // Update teacher
    Route::middleware(['permission:teacher_delete'])->delete('/teacher/{id}/destroy', [TeacherController::class, 'destroy'])->name('teacher.destroy'); // Delete teacher
    Route::get('/teacher/{user_id}/generate-id', [TeacherController::class, 'generateID'])->name('admin.teacher.generateID');


    // 🟢 Complaint Box Routes with Spatie Permissions
    Route::middleware(['permission:complaint_view'])->get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index'); // View complaints list
    Route::middleware(['permission:complaint_view'])->get('/complaints/{id}', [ComplaintController::class, 'show'])->name('complaints.show'); // View a single complaint
    Route::middleware(['permission:complaint_delete'])->delete('/complaints/{id}', [ComplaintController::class, 'destroy'])->name('complaints.destroy'); // Delete a complaint


    Route::prefix('students')->group(function () {
        Route::get('/due', [StudentController::class, 'dueStudents'])->name('students.due');
        Route::get('/due/{id}', [StudentController::class, 'dueStudentDetails'])->name('students.due.details');

        Route::get('/id-card', [StudentController::class, 'searchIdCard']); // Search page
        Route::get('/{dhakila_number}/show', [StudentController::class, 'show'])->name('students.show'); // Show single student
        Route::get('/{dhakila_number}/generate-id', [StudentController::class, 'generateID'])->name('admin.student.generateID');
        // Route::get('/{id}/generate_id', [StudentController::class, 'generateID'])->name('students.generate_id'); // Generate ID card
        Route::get('/payments/{dhakila_number}', [StudentController::class, 'getPayments'])->name('admin.student.payments');
        Route::get('/attendances/{id}', [StudentController::class, 'getAttendances'])->name('admin.student.attendances');

        // Route::middleware(['auth'])->get('/students/{dhakila_number}/payments', [StudentController::class, 'getPayments'])->name('student.payments');
        // Route::middleware(['auth'])->get('/students/{dhakila_number}/attendances', [StudentController::class, 'getAttendances'])->name('student.attendances');

        Route::middleware(['permission:student_view'])->get('/students/profile', [StudentController::class, 'studentProfile'])->name('student.profile');
        Route::get('/students/search', [StudentController::class, 'searchStudent'])->name('student.search');
    });


    // 🟢 Student Management Routes with Spatie Permissions
    Route::middleware(['permission:student_view'])->get('/students', [StudentController::class, 'index'])->name('students.index'); // View students list
    Route::middleware(['permission:student_view'])->get('/inactive-student', [StudentController::class, 'indexInactive'])->name('students.inactive'); // View students list
    Route::middleware(['permission:student_add'])->get('/students/create', [StudentController::class, 'create'])->name('students.create'); // Show form to create student
    Route::middleware(['permission:student_add'])->post('/students/store', [StudentController::class, 'store'])->name('students.store'); // Store student data
    Route::middleware(['permission:student_edit'])->get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit'); // Show form to edit student
    Route::middleware(['permission:student_edit'])->put('/students/{id}/update', [StudentController::class, 'update'])->name('students.update'); // Update student data
    Route::middleware(['permission:student_delete'])->delete('/students/{id}/destroy', [StudentController::class, 'destroy'])->name('students.destroy'); // Delete student


});


Route::prefix('panel')->middleware(['auth', 'checkRole:student'])->group(function () {

    // Student Dashboard Route
    Route::get('studentD', [HomeController::class, 'studentD'])->name('studentD');
    Route::get('/student/admit-card/{exam_id}/{student_id}', [StudentController::class, 'admitCard'])->name('student.admitCard');
    // Generate ID Route
    Route::get('/student/{dhakila_number}/generate-id', [StudentController::class, 'generateID'])->name('student.generateID');

    // Payments and Attendance Routes
    Route::get('/students/{dhakila_number}/payments', [HomeController::class, 'getPayments'])->name('student.payments');
    Route::get('/students/{dhakila_number}/attendances', [HomeController::class, 'getAttendances'])->name('student.attendances');

    Route::get('/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('users.update-password');
    // Route::get('/results/{exam_id}/{student_id}', [ExamController::class, 'viewResults'])->name('viewResults');
});











//Gallery Routes
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');



// Complaints Routes

Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');








// Route::get('notices/trash', [NoticeController::class, 'trash_index'])->name('notices.trash');
// Route::get('notices/restore/{id}', [NoticeController::class, 'trash_restore'])->name('notices.restore');
// Route::delete('notices/permanentDelete/{id}', [NoticeController::class, 'trash_permanentDelete'])->name('notices.permanentDelete');




//notice routes
Route::get('/notice', [PageController::class, 'notice'])->name('notice');
Route::get('/singelnotice/{id}', [PageController::class, 'singelnotice'])->name('singelnotice');






Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/courses', [PageController::class, 'course'])->name('course');
Route::get('/course-details/{slug}', [PageController::class, 'courseDetails'])->name('course.details');
Route::get('/success-stories', [PageController::class, 'successStory'])->name('success.stories');
