<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PaymentsExport;
use App\Http\Controllers\Controller;
use App\Models\Bibag;
use App\Models\Payment;
use App\Models\PaymentAttachment;
use App\Models\Purpose;
use App\Models\Sreni;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use App\Helpers\SmsHelper;


class PaymentController extends Controller
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
            'permission:payment_view' => ['index'],
            'permission:payment_add' => ['create', 'store'],
            'permission:payment_edit' => ['edit', 'update'],
            'permission:payment_delete' => ['destroy'],
        ];
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::with('sreni', 'bibag', 'purpose')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('sreni', function ($row) {
                //     return $row->sreni->name; // Adjust based on your Sreni model
                // })
                // ->addColumn('bibag', function ($row) {
                //     return $row->bibag->name; // Adjust based on your Sreni model
                // })
                ->addColumn('sreni', function ($row) {
                return optional($row->sreni)->name ?? 'N/A';
            })
            ->addColumn('bibag', function ($row) {
                return optional($row->bibag)->name ?? 'N/A';
            })
            ->addColumn('purpose', function ($row) {
                return optional($row->purpose)->purpose_name ?? 'N/A';
            })
                ->addColumn('amount', function ($row) {
                    return $row->amount . " TK";
                })
                ->addColumn('date', function ($row) {
                    $date = $row->date ? new Carbon($row->date) : null;
                    return $date ? $date->format("d-m-Y") : 'N/A';
                })
                // ->addColumn('purpose', function ($row) {
                //     return $row->purpose->purpose_name;
                // })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('payments.destroy', $row);
                    $edit_api = route('payments.edit', $row);
                    // $seo_api = route('product_seos.create', $row->id);
                    $csrf = csrf_token();
                    $action = <<<CODE
                <form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>

                    <input name='_method' type='hidden' value='DELETE'><input name='_token' type='hidden' value='$csrf'>
                    <a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='$edit_api' data-original-title='Edit product details'>
                    <i class="ri-edit-box-fill"></i>
                    </a>

                    <button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='' data-original-title='Delete product'>
                     <i class="ri-delete-bin-fill"></i>
                    </button>
                </form>

                <button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                <i class="ri-eye-fill"></i>
                CODE;

                    return $action;
                })
                ->rawColumns(['actions', 'sreni', 'bibag'])
                ->make(true);
        }

        $srenis = Sreni::all(); // Assuming Sreni represents classes
        $bibags = Bibag::all(); // Assuming Sreni represents classes
        $purposes = Purpose::all(); // Assuming Sreni represents classes
        return view('admin.payment.index', compact('srenis', 'bibags', 'purposes'));
    }

    public function payment_report(Request $request)
    {
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
        $purpose_id = $request->input('purpose_id');
        $bibag_id = $request->input('bibag_id'); // ✅ New line
    
        $query = Payment::with('sreni', 'bibag', 'purpose')->latest();
    
        if ($fromDate && $toDate) {
            if ($fromDate > $toDate) {
                return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
            }
            $query->whereDate('payments.date', '>=', $fromDate)
                  ->whereDate('payments.date', '<=', $toDate);
        } elseif ($fromDate) {
            $query->whereDate('payments.date', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('payments.date', '<=', $toDate);
        }
    
        if ($purpose_id) {
            $query->where('payments.purpose_id', $purpose_id);
        }
    
        if ($bibag_id) { // ✅ New condition
            $query->where('payments.bibag_id', $bibag_id);
        }
    
        $totalAmount = $query->sum('amount');
    
        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('created_at_read', fn($row) => $row->created_at->diffForHumans())
                ->addColumn('expense_head', fn($row) => $row->expense_head_name)
                ->addColumn('amount', fn($row) => $row->amount . " TK")
                ->addColumn('sreni', fn($row) => optional($row->sreni)->name ?? 'N/A')
                ->addColumn('bibag', fn($row) => optional($row->bibag)->name ?? 'N/A')
                ->addColumn('purpose', fn($row) => optional($row->purpose)->purpose_name ?? 'N/A')
                ->addColumn('date', fn($row) => $row->date ? Carbon::parse($row->date)->format("d-m-Y") : 'N/A')
                ->addColumn('actions', function ($row) {
                    $delete_api = route('payments.destroy', $row);
                    $edit_api = route('payments.edit', $row);
                    $csrf = csrf_token();
                    return <<<CODE
                    <form method='POST' action='$delete_api' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>
                        <a class='btn btn-info btn-sm m-1' href='$edit_api'><i class="ri-edit-box-fill"></i></a>
                        <button type='submit' class='btn delete btn-danger btn-sm m-1'><i class="ri-delete-bin-fill"></i></button>
                    </form>
                    <button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}'><i class="ri-eye-fill"></i></button>
                    CODE;
                })
                ->rawColumns(['created_at_read', 'actions', 'expense_head'])
                ->make(true);
        }
    
        $srenis = Sreni::all();
        $bibags = Bibag::all(); // ✅ Already present
        $purposes = Purpose::all();
    
        return view('admin.payment.payments_report', compact('srenis', 'bibags', 'purposes', 'totalAmount'));
    }
    
    
    

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'reciept_no' => 'required|unique:payments,reciept_no',
    //         'date' => 'required|date_format:d-m-Y',
    //         'name' => 'required|string|max:255',
    //         'dhakila_number' => 'nullable|numeric',

    //         'mobile' => 'required|string|max:15', // Validate mobile

    //         'address' => 'required|string|max:255',
    //         'amount' => 'required|numeric|min:0',
    //         'amount_in_words' => 'required|string|max:255',
    //         'sreni_id' => 'required|exists:srenis,id',
    //         'bibag_id' => 'required|exists:bibags,id',
    //         'purpose_id' => 'required|exists:purposes,id',
    //         'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // 512 KB
    //         // 'amount_in_words' will be handled server-side
    //     ]);

    //     $payment =  Payment::create([
    //         'reciept_no' => $request->reciept_no,
    //         'date' => Carbon::createFromFormat('d-m-Y', $request->date),
    //         'name' => $request->name,
    //         'dhakila_number' => $request->dhakila_number,
    //         'address' => $request->address,
    //         'purpose_id' => $request->purpose_id,
    //         'amount' => $request->amount,
    //         'amount_in_words' => $request->amount_in_words,
    //         'sreni_id' => $request->sreni_id,
    //         'bibag_id' => $request->bibag_id,
    //     ]);

    //     if ($request->hasFile('attachments')) {
    //         $files = $request->file('attachments');
 
    //         foreach ($files as $file) {
    //             $filenameWithExt = $file->getClientOriginalName();
    //             $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //             $extension       = $file->getClientOriginalExtension();
    //             $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    //             $file->move(public_path('assets/attachements'), $fileNameToStore);

    //             PaymentAttachment::create([
    //                 'payment_id' => $payment->id,
    //                 'file_path' => $fileNameToStore,
    //                 'file_name' => $fileNameToStore,
    //                 'file_type' => $extension, // Add this field to the database
    //             ]);
    //         }
    //     }

    //     // ✅ SMS Send Section (Example using API like SMS API BD or others)
    //     $mobile = $request->mobile;
    //     $smsBody = "Payment Received:\n"
    //             . "Name: {$request->name}\n"
    //             . "Amount: {$request->amount} Tk\n"
    //             . "Receipt No: {$request->reciept_no}\n"
    //             . "Date: {$request->date}\n"
    //             . "Thank you!";

    //     // Replace below with your SMS API (e.g., sms.net.bd)
    //     Http::get("https://api.yoursmsprovider.com/send", [
    //         'api_key' => 'your_api_key',
    //         'to' => $mobile,
    //         'message' => $smsBody,
    //         // 'sender_id' => 'GROWSOFT' // Optional
    //     ]);

    //     return response()->json(['success' => "Payment created Successfully"]);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'reciept_no' => 'required|unique:payments,reciept_no',
            'date' => 'required|date_format:d-m-Y',
            'name' => 'required|string|max:255',
            'dhakila_number' => 'nullable|numeric',
            'address' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'amount_in_words' => 'required|string|max:255',
            'sreni_id' => 'required|exists:srenis,id',
            'bibag_id' => 'required|exists:bibags,id',
            'purpose_id' => 'required|exists:purposes,id',
            'mobile' => 'required|regex:/^01[0-9]{9}$/', // Add this for mobile validation
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512',
        ]);

        $payment = Payment::create([
            'reciept_no' => $request->reciept_no,
            'date' => Carbon::createFromFormat('d-m-Y', $request->date),
            'name' => $request->name,
            'dhakila_number' => $request->dhakila_number,
            'address' => $request->address,
            'purpose_id' => $request->purpose_id,
            'amount' => $request->amount,
            'amount_in_words' => $request->amount_in_words,
            'sreni_id' => $request->sreni_id,
            'bibag_id' => $request->bibag_id,
        ]);

        // ✅ File Uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $storedName = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $storedName);

                PaymentAttachment::create([
                    'payment_id' => $payment->id,
                    'file_path' => $storedName,
                    'file_name' => $storedName,
                    'file_type' => $extension,
                ]);
            }
        }

         // ✅ SMS Body তৈরি
            $message = "Payment Received:\n"
            . "Name: {$request->name}\n"
            . "Amount: {$request->amount} Tk\n"
            . "Receipt No: {$request->reciept_no}\n"
            . "Date: {$request->date}\n"
            . "Thank you!\n"
            . "Gen-Z IT Institute";

        // ✅ SMS পাঠানো `SmsHelper` দিয়ে
        $response = SmsHelper::sendSms($request->mobile, $message);

        if (isset($response['status']) && $response['status'] != 'success') {
        return redirect()->back()->with('error', 'SMS failed to send.');
        }
        return response()->json(['success' => "Payment created and SMS sent successfully"]);
    }


    public function edit(Payment $payment )
    {
        $srenis = Sreni::all();
        $bibags = Bibag::all();
        $purposes = Purpose::all();
        $attachments = $payment->attachments()->get();
        return view('admin.payment.edit', compact('payment', 'srenis', 'bibags', 'purposes', 'attachments'));
    }

    public function update(Request $request, $id)
    {
        // Ensure the ID is correctly passed and the Payment is found
        $payment = Payment::findOrFail($id);

        // Validate the request
        $request->validate([
            'reciept_no' => 'required|unique:payments,reciept_no,' . $payment->id,
            'date' => 'required|date_format:d-m-Y',
            'name' => 'required|string|max:255',
            'dhakila_number' => 'required|integer',
            'address' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'sreni_id' => 'required|exists:srenis,id',
            'bibag_id' => 'required|exists:bibags,id',
            'purpose_id' => 'required|exists:purposes,id',
            'amount_in_words' => 'required|string|max:255',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512',
            'delete_attachments' => 'array',
            'delete_attachments.*' => 'integer|exists:payment_attachments,id',
        ]);

        // Update Payment data
        $payment->update([
            'reciept_no' => $request->reciept_no,
            'date' => Carbon::createFromFormat('d-m-Y', $request->date),
            'name' => $request->name,
            'dhakila_number' => $request->dhakila_number,
            'address' => $request->address,
            'amount' => $request->amount,
            'sreni_id' => $request->sreni_id,
            'bibag_id' => $request->bibag_id,
            'purpose_id' => $request->purpose_id,
            'amount_in_words' => $request->amount_in_words,
        ]);

        // Handle the deletion of attachments
        if ($request->has('delete_attachments')) {
            $attachmentsToDelete = PaymentAttachment::whereIn('id', $request->delete_attachments)->get();
            foreach ($attachmentsToDelete as $attachment) {
                if (file_exists(public_path('assets/attachements/' . $attachment->file_path))) {
                    unlink(public_path('assets/attachements/' . $attachment->file_path));
                }
                $attachment->delete();
            }
        }

        // Handle new attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                PaymentAttachment::create([
                    'payment_id' => $payment->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $filenameWithExt,
                    'file_type' => $extension
                ]);
            }
        }

        return response()->json(['success' => "Payment updated successfully"]);
    }


    public function destroy(Payment $payment)
    {

        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }

    public function exportExcel(Request $request)
{
    $request->validate([
        'from_date' => 'nullable|date',
        'to_date' => 'nullable|date|after_or_equal:from_date',
        'purpose_id' => 'nullable|exists:purposes,id',
        'bibag_id' => 'nullable|exists:bibags,id',
    ], [
        'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
    ]);

    $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : null;
    $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : null;
    $purposeId = $request->input('purpose_id');
    $bibagId = $request->input('bibag_id');

    $filename = 'payment';
    if ($fromDate && $toDate) {
        $filename .= '_from_' . $fromDate->format('d-m-Y') . '_to_' . $toDate->format('d-m-Y');
    } elseif ($fromDate) {
        $filename .= '_from_' . $fromDate->format('d-m-Y');
    } elseif ($toDate) {
        $filename .= '_to_' . $toDate->format('d-m-Y');
    }
    $filename .= '.xlsx';

    return Excel::download(new PaymentsExport($fromDate, $toDate, $purposeId, $bibagId), $filename);
}

public function exportPDF(Request $request)
{
    $request->validate([
        'from_date' => 'nullable|date',
        'to_date' => 'nullable|date|after_or_equal:from_date',
        'purpose_id' => 'nullable|exists:purposes,id',
        'bibag_id' => 'nullable|exists:bibags,id',
    ], [
        'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
    ]);

    $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : null;
    $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : null;
    $purposeId = $request->input('purpose_id');
    $bibagId = $request->input('bibag_id');

    $query = Payment::with('sreni', 'bibag', 'purpose')->latest();

    $query->when($fromDate, fn($q) => $q->whereDate('payments.created_at', '>=', $fromDate));
    $query->when($toDate, fn($q) => $q->whereDate('payments.created_at', '<=', $toDate));
    $query->when($purposeId, fn($q) => $q->where('payments.purpose_id', $purposeId));
    $query->when($bibagId, fn($q) => $q->where('payments.bibag_id', $bibagId));

    $payments = $query->get();
    $totalAmount = $payments->sum('amount');

    $bibagName = $bibagId ? Bibag::find($bibagId)?->name : null;
    $purposeName = $purposeId ? Purpose::find($purposeId)?->name : null;

    $filename = 'payment';
    if ($fromDate && $toDate) {
        $filename .= '_from_' . $fromDate->format('d-m-Y') . '_to_' . $toDate->format('d-m-Y');
    } elseif ($fromDate) {
        $filename .= '_from_' . $fromDate->format('d-m-Y');
    } elseif ($toDate) {
        $filename .= '_to_' . $toDate->format('d-m-Y');
    }
    $filename .= '.pdf';

    $pdf = Pdf::loadView('admin.payment.export_pdf', [
        'payments' => $payments,
        'fromDate' => $fromDate,
        'toDate' => $toDate,
        'totalAmount' => $totalAmount,
        'bibagName' => $bibagName,
        'purposeName' => $purposeName,
    ])->setPaper('a4', 'landscape');

    return $pdf->download($filename);
}

    public function getAttachments(Payment $payment)
    {
        $attachments = $payment->attachments()->get(['file_path', 'file_name', 'file_type']);

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
}
