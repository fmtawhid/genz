<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Payment;
use App\Models\Student;
use App\Models\Expense;
use App\Models\attendance;
use App\Models\TeacherAttendance;
use App\Models\Sreni;
use App\Models\AssignedFee;
use App\Models\Complaint;
use App\Models\Notice;
use App\Models\Purpose;
use App\Models\User;
use App\Models\Exam;
use App\Models\Subject;
use DataTables;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        // Calculate the total payment amount
        $totalAmount = Payment::sum('amount');
        $totalStudents = Student::where('type', 'active')->count();
        $totalExpenses = Expense::sum('amount');
        $totalProfit = $totalAmount - $totalExpenses;


        // Last 30 Days Data
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $totalPaymentsLast30Days = Payment::where('created_at', '>=', $thirtyDaysAgo)->sum('amount');
        $totalStudentsLast30Days = Student::where('created_at', '>=', $thirtyDaysAgo)
            ->where('type', 'Active')
            ->count();

        $totalExpensesLast30Days = Expense::where('created_at', '>=', $thirtyDaysAgo)->sum('amount');
        $totalProfitLast30Days = $totalPaymentsLast30Days - $totalExpensesLast30Days;

        $complaints = Complaint::all();
        $notices = Notice::all();



        // Speacific Payment
        $revenues = Payment::selectRaw('purpose_id, SUM(amount) as total_amount')
            ->groupBy('purpose_id')
            ->get();

        // Fetching total payments for the last 30 days grouped by purpose_id
        $revenuesLast30Days = Payment::where('created_at', '>=', $thirtyDaysAgo)
            ->selectRaw('purpose_id, SUM(amount) as total_amount')
            ->groupBy('purpose_id')
            ->get();

        // dd($revenues);


        // Specific Cost
        $expenses = Expense::selectRaw('expense_head_id, SUM(amount) as total_amount')
            ->groupBy('expense_head_id')
            ->with('expenseHead')
            ->get();
        // Last 30 Days Expenses

        // Last 30 Days Expenses: Get the total expenses for the last 30 days per `expense_head_id`
        $expensesLast30Days = Expense::where('created_at', '>=', $thirtyDaysAgo)
            ->selectRaw('expense_head_id, SUM(amount) as total_amount')
            ->groupBy('expense_head_id')
            ->with('expenseHead')
            ->get();



        // Passing data to the view
        return view('admin.dashboard.index', [
            'totalAmount' => $totalAmount,
            'totalStudents' => $totalStudents,
            'totalExpenses' => $totalExpenses,
            'totalProfit' => $totalProfit,
            // Last 30 Days
            'totalPaymentsLast30Days' => $totalPaymentsLast30Days,
            'totalStudentsLast30Days' => $totalStudentsLast30Days,
            'totalExpensesLast30Days' => $totalExpensesLast30Days,
            'totalProfitLast30Days' => $totalProfitLast30Days,
            'complaints' => $complaints,
            'notices' => $notices,
            'revenues' => $revenues,
            'expenses' => $expenses,
            'expensesLast30Days' => $expensesLast30Days,
            'revenuesLast30Days' => $revenuesLast30Days,


        ]);
    }

   
public function studentD(Request $request)
{
    $user = auth()->user();

    if ($user && $user->student_dhakila_number) {
        $student = Student::where('dhakila_number', $user->student_dhakila_number)->first();

        if ($student) {
            // Fetch related data
            $payments = $student->payments;
            $attendances = $student->attendances ?? collect([]);
            $attachments = $student->attachments;
            $exams = $student->exams;

            // Class & subject
            $sreni = $student->sreni;
           
            

        

            $activeTab = 'basic-info';
          
            $totalPayments = $payments->sum('amount');
            // ✅ নতুন ভ্যারিয়েবল $fees পাঠানো হলো view-এ
            return view('admin.dashboard.student', compact(
                'student', 'payments', 'attendances', 'attachments',
                'exams', 'sreni', 'activeTab', 
            ));
        } else {
            return redirect()->route('studentD')->with('error', 'Student profile not found.');
        }
    }

    return redirect()->route('studentD')->with('error', 'User does not have a valid student profile.');
}

// public function studentD(Request $request)
// {
//     $user = auth()->user();
//     if ($user && $user->student_dhakila_number) {
//         $student = Student::where('dhakila_number', $user->student_dhakila_number)->first();

//         if ($student) {
//             // Fetch payments, attendances, and exams for the student
//             $payments = $student->payments;
//             $attendances = $student->attendances ?? collect([]);
//             $attachments = $student->attachments;
//             $exams = $student->exams;

//             // Fetch the class (Sreni) the student belongs to and its subjects
//             $sreni = $student->sreni;
//             $subjects = Subject::where('sreni_id', $sreni->id)->get();

//             // Fetch lessons for each subject and eager load 'subject' relation
//             $lessons = collect();
//             foreach ($subjects as $subject) {
//                 $lessons = $lessons->merge($subject->lessons()->with('subject')->get());  // Eager load 'subject'
//             }

            
 
//             if ($request->ajax()) {
//                 // Returning data for DataTables
//                 return response()->json([
//                     'exams' => DataTables::of($exams)->make(true)->getData(),
//                     'lessons' => DataTables::of($lessons)->make(true)->getData(),
//                 ]);
//             }

//             $activeTab = 'basic-info';



            
//             return view('admin.dashboard.student', compact('student', 'payments', 'attendances', 'attachments', 'exams', 'sreni', 'subjects', 'lessons', 'activeTab'));
//         } else {
//             return redirect()->route('studentD')->with('error', 'Student profile not found.');
//         }
//     }

//     return redirect()->route('studentD')->with('error', 'User does not have a valid student profile.');
// }




    public function getPayments($dhakila_number)
    {
        $payments = Payment::where('dhakila_number', $dhakila_number)
            ->join('purposes', 'payments.purpose_id', '=', 'purposes.id')
            ->select('payments.id', 'payments.reciept_no', 'payments.date', 'payments.amount', 'purposes.purpose_name');

        return DataTables::of($payments)
            ->addIndexColumn()  // Adds a serial number column
            ->make(true);
    }

    public function getAttendances($dhakila_number)
    {
        $attendances = Attendance::join('students', 'attendances.student_id', '=', 'students.id')
            ->join('attendance_types', 'attendances.attendance_type_id', '=', 'attendance_types.id')
            ->where('students.dhakila_number', $dhakila_number)  // Filter using dhakila_number from students table
            ->select(
                'attendances.id',
                'attendances.date',
                'attendance_types.name as attendance_type',
                'attendance_types.color',
                'attendances.remark'
            );

        return DataTables::of($attendances)
            ->addIndexColumn()
            ->editColumn('attendance_type', function ($attendance) {
                return "<span style='color: {$attendance->color}; font-weight: bold;'>{$attendance->attendance_type}</span>";
            })
            ->rawColumns(['attendance_type'])
            ->make(true);
    }

   



    // Method to show student profile based on dhakila_number from User table
    // public function studentD()
    // {
    //     // Get the logged-in user
    //     $user = auth()->user();

    //     // Check if the user has a dhakila_number
    //     if ($user && $user->student_dhakila_number) {
    //         // Find the student using the dhakila_number from the user
    //         $student = Student::where('dhakila_number', $user->student_dhakila_number)->first();

    //         // If the student is found, fetch the necessary information
    //         if ($student) {
    //             // Fetch payments, attendances, and attachments for the student
    //             $payments = $student->payments;
    //             $attendances = $student->attendances ?? collect([]);
    //             $attachments = $student->attachments;

    //             // Set the active tab to basic-info by default
    //             $activeTab = 'basic-info';

    //             // Return the view with the student data and related info
    //             return view('admin.dashboard.student', compact('student', 'payments', 'attendances', 'attachments', 'activeTab'));
    //         } else {
    //             return redirect()->route('studentD')->with('error', 'Student profile not found.');
    //         }
    //     }

    //     return redirect()->route('studentD')->with('error', 'User does not have a valid student profile.');
    // }


}
