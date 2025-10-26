<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SmsHelper;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Sreni;
use App\Models\Bibag;
use App\Models\SreniSection;

class SmsController extends Controller
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
            'permission:sms_add' => ['sendSmsToStudent', 'smsForm'],
        ];
    }

    public function sendSmsToStudent(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',  // Validate phone number as a string (it can have multiple numbers separated by commas)
            'message' => 'required|string|max:160',
        ]);

        $phoneNumbers = explode(',', $request->input('phone_number'));  // Separate the phone numbers by comma
        $message = $request->input('message') . "\n\nTalimul Islam School and Madrasha";

        // Loop through each phone number and send SMS
        foreach ($phoneNumbers as $phoneNumber) {
            $phoneNumber = trim($phoneNumber);  // Remove any extra spaces
            if (preg_match('/^\d{11}$/', $phoneNumber)) {  // Check if the phone number is valid (11 digits)
                $response = SmsHelper::sendSms($phoneNumber, $message);

                // Check if 'status' exists in the response array
                if (isset($response['status']) && $response['status'] != 'success') {
                    return redirect()->back()->with('error', 'Failed to send SMS.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid phone number: ' . $phoneNumber);
            }
        }

        return redirect()->back()->with('success', 'SMS sent successfully!');
    }
    // সব Student ফোন নম্বর
    public function getAllStudentNumbers()
    {
        $numbers = Student::pluck('mobile')->toArray();
        return response()->json(['success' => true, 'phone_numbers' => $numbers]);
    }

    // নির্দিষ্ট Sreni ID এর Student ফোন নম্বর
    public function getClassPhoneNumbers($sreniId)
    {
        $numbers = Student::where('sreni_id', $sreniId)->pluck('mobile')->toArray();
        return response()->json(['success' => true, 'phone_numbers' => $numbers]);
    }

    // সকল Teacher ফোন নম্বর
    public function getTeacherNumbers()
    {
        $numbers = Teacher::pluck('phone_number')->toArray();
        return response()->json(['success' => true, 'phone_numbers' => $numbers]);
    }

    // Student + Teacher মিলিয়ে সব ফোন নম্বর (ডুপ্লিকেট ছাড়া)
    public function getAllNumbers()
    {
        $studentNumbers = Student::pluck('mobile')->toArray();
        $teacherNumbers = Teacher::pluck('phone_number')->toArray();
        $allNumbers = array_unique(array_merge($studentNumbers, $teacherNumbers));

        return response()->json(['success' => true, 'phone_numbers' => $allNumbers]);
    }


    public function smsForm()
    {
        $srenis = Sreni::all(); // Assuming Sreni is the model for "Sreni"
        $sections = SreniSection::all();
        $bibags = Bibag::all(); // Assuming Bibag is the model for "Bibag"
        return view('admin.sms.view', compact('srenis', 'sections', 'bibags'));
    }

    public function getSectionsByBibagSreni(Request $request)
    {
        $bibagId = $request->input('bibag_id');
        $sreniId = $request->input('sreni_id');
        $sections = SreniSection::where('bibag_id', $bibagId)
            ->where('sreni_id', $sreniId)
            ->get();
        return response()->json($sections);
    }

    public function getNumbersByBibagSreniSection(Request $request)
    {
        $bibagId = $request->input('bibag_id');
        $sreniId = $request->input('sreni_id');
        $sectionId = $request->input('section_id');

        $query = Student::query();
        if ($bibagId)
            $query->where('bibag_id', $bibagId);
        if ($sreniId)
            $query->where('sreni_id', $sreniId);
        if ($sectionId)
            $query->where('section_id', $sectionId);

        $numbers = $query->pluck('mobile')->toArray();
        return response()->json(['success' => true, 'phone_numbers' => $numbers]);
    }



}
