<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExpensesExport;
use App\Models\Expense;
use App\Models\ExpenseAttachment;
use App\Models\ExpenseHead;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DataTables;
use Excel;

class ExpenseController extends Controller
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
            'permission:expense_view' => [ 'export_report'],
            'permission:expense_add' => ['create', 'store', 'index'],
            'permission:expense_edit' => ['edit', 'update'],
            'permission:expense_delete' => ['destroy'],
        ];
    }
    // public function index()
    // {
    //     // Fetch expenses with their associated expense head, joined with expense_heads table
    //     $expensesQuery = Expense::with('expenseHead')
    //         ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
    //         ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
    //         ->latest();

    //     // Fetch all expense heads for dropdowns or filters in the view
    //     $expenseHeads = ExpenseHead::all();

    //     // Check if the request is an AJAX call
    //     if (request()->ajax()) {
    //         return DataTables::of($expensesQuery)
    //             ->addIndexColumn() // Adds a sequential index column
    //             ->addColumn('created_at_read', function ($row) {
    //                 return $row->created_at->diffForHumans();
    //             })
    //             ->addColumn('expense_head', function ($row) {
    //                 return $row->expense_head_name;
    //             })
    //             ->addColumn('date', function ($row) {
    //                 $date = $row->date ? new Carbon($row->date) : null;
    //                 return $date ? $date->format("d-m-Y") : 'N/A';
    //             })
    //             ->addColumn('amount', function ($row) {
    //                 return $row->amount . " TK";
    //             })
    //             ->addColumn('actions', function ($row) {
    //                 $delete_api = route('expenses.destroy', $row);
    //                 $edit_api = route('expenses.edit', $row);
    //                 $csrf = csrf_token();
    //                 $action = <<<CODE
    //             <form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>

    //                 <input name='_method' type='hidden' value='DELETE'><input name='_token' type='hidden' value='$csrf'>
    //                 <a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='$edit_api' data-original-title='Edit product details'>
    //                 <i class="ri-edit-box-fill"></i>
    //                 </a>

    //                 <button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='' data-original-title='Delete product'>
    //                  <i class="ri-delete-bin-fill"></i>
    //                 </button>
    //             </form>

    //              <button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
    //                 <i class="ri-eye-fill"></i>
    //             </button>

    //             CODE;

    //                 return $action;
    //             })
    //             ->rawColumns(['created_at_read', 'actions', 'expense_head'])
    //             ->make(true);
    //     }

    //     // Return the view with expenses and expense heads data
    //     return view('admin.expenses.index', compact('expenseHeads'));
    // }

    public function index()
{
    // Fetch expenses with their associated expense head, joined with expense_heads table
    $expensesQuery = Expense::with('expenseHead')
        ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
        ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
        ->latest();

    // Fetch all expense heads for dropdowns or filters in the view
    $expenseHeads = ExpenseHead::all();

    // Check if the request is an AJAX call
    if (request()->ajax()) {
        return DataTables::of($expensesQuery)
            ->addIndexColumn() // Adds a sequential index column
            ->addColumn('created_at_read', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('expense_head', function ($row) {
                return $row->expense_head_name;
            })
            ->addColumn('date', function ($row) {
                $date = $row->date ? new Carbon($row->date) : null;
                return $date ? $date->format("d-m-Y") : 'N/A';
            })
            ->addColumn('amount', function ($row) {
                return $row->amount . " TK";
            })
            ->addColumn('actions', function ($row) {
                $delete_api = route('expenses.destroy', $row);
                $edit_api = route('expenses.edit', $row);
                $csrf = csrf_token();
                $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                    <input name='_method' type='hidden' value='DELETE'>
                    <input name='_token' type='hidden' value='$csrf'>";

                // Add Edit Button if the user has the 'expense_edit' permission
                if (auth()->user()->can('expense_edit')) {
                    $action .= "<a class='btn btn-info btn-sm m-1' data-toggle='tooltip' title='Edit expense details' href='$edit_api'>
                        <i class='ri-edit-box-fill'></i>
                    </a>";
                }

                // Add Delete Button if the user has the 'expense_delete' permission
                if (auth()->user()->can('expense_delete')) {
                    $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' title='Delete expense'>
                        <i class='ri-delete-bin-fill'></i>
                    </button>";
                }

                // Close the form tag
                $action .= "</form>";

                // Add additional buttons like 'View Attachments'
                $action .= "<button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                    <i class='ri-eye-fill'></i>
                </button>";

                return $action;
            })
            ->rawColumns(['created_at_read', 'actions', 'expense_head'])
            ->make(true);
    }

    // Return the view with expenses and expense heads data
    return view('admin.expenses.index', compact('expenseHeads'));
}


    
    // public function export_report(Request $request)
    // {
    //     // Retrieve date filters from the request
    //     $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : "";
    //     $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
    //     $expense_head_id = $request->input('expense_head_id');

    //     $expensesQuery = Expense::with('expenseHead')
    //         ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
    //         ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
    //         ->latest();

    //     // Apply date filters if provided
    //     if ($fromDate && $toDate) {
    //         if ($fromDate > $toDate) {
    //             return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
    //         }

    //         $expensesQuery->whereDate('expenses.date', '>=', $fromDate)
    //             ->whereDate('expenses.date', '<=', $toDate);
    //     } elseif ($fromDate) {
    //         $expensesQuery->whereDate('expenses.date', '>=', $fromDate);
    //     } elseif ($toDate) {
    //         $expensesQuery->whereDate('expenses.date', '<=', $toDate);
    //     }

    //     if ($expense_head_id) {
    //         $expensesQuery->where('expenses.expense_head_id', $expense_head_id);
    //     }

    //     $expenseHeads = ExpenseHead::all();

    //     if (request()->ajax()) {
    //         return DataTables::of($expensesQuery)
    //             ->addIndexColumn() // Adds a sequential index column
    //             ->addColumn('created_at_read', function ($row) {
    //                 return $row->created_at->diffForHumans();
    //             })
    //             ->addColumn('expense_head', function ($row) {
    //                 return $row->expense_head_name;
    //             })
    //             ->addColumn('amount', function ($row) {
    //                 return $row->amount . " TK";
    //             })
    //             ->addColumn('date', function ($row) {
    //                 $date = $row->date ? new Carbon($row->date) : null;
    //                 return $date ? $date->format("d-m-Y") : 'N/A';
    //             })
    //             ->addColumn('actions', function ($row) {
    //                 $delete_api = route('expenses.destroy', $row);
    //                 $edit_api = route('expenses.edit', $row);
    //                 $csrf = csrf_token();
    //                 $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
    //                     <input name='_method' type='hidden' value='DELETE'>
    //                     <input name='_token' type='hidden' value='$csrf'>";

    //                 // Add Edit Button if the user has the 'expense_edit' permission
    //                 if (auth()->user()->can('expense_edit')) {
    //                     $action .= "<a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='Edit expense details' href='$edit_api'>
    //                         <i class='ri-edit-box-fill'></i>
    //                     </a>";
    //                 }

    //                 // Add Delete Button if the user has the 'expense_delete' permission
    //                 if (auth()->user()->can('expense_delete')) {
    //                     $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='Delete expense'>
    //                         <i class='ri-delete-bin-fill'></i>
    //                     </button>";
    //                 }

    //                 // Close the form tag
    //                 $action .= "</form>";

    //                 // Add extra buttons for viewing attachments
    //                 $action .= "<button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
    //                     <i class='ri-eye-fill'></i>
    //                 </button>";

    //                 return $action;
    //             })
    //             ->rawColumns(['created_at_read', 'actions', 'expense_head'])
    //             ->make(true);
    //     }

    //     return view('admin.expenses.expense_report', compact('expenseHeads'));
    // }
public function export_report(Request $request)
{
    // Retrieve date filters from the request
    $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : "";
    $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
    $expense_head_id = $request->input('expense_head_id');

    $expensesQuery = Expense::with('expenseHead')
        ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
        ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
        ->latest();

    // Apply date filters if provided
    if ($fromDate && $toDate) {
        if ($fromDate > $toDate) {
            return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
        }

        $expensesQuery->whereDate('expenses.date', '>=', $fromDate)
            ->whereDate('expenses.date', '<=', $toDate);
    } elseif ($fromDate) {
        $expensesQuery->whereDate('expenses.date', '>=', $fromDate);
    } elseif ($toDate) {
        $expensesQuery->whereDate('expenses.date', '<=', $toDate);
    }

    if ($expense_head_id) {
        $expensesQuery->where('expenses.expense_head_id', $expense_head_id);
    }

    $expenseHeads = ExpenseHead::all();

    // Get the filtered expenses for calculating the total
    $filteredExpenses = $expensesQuery->get();

    // Calculate total amount for filtered expenses only
    $totalAmount = $filteredExpenses->sum('amount');

    // Handling DataTables for AJAX request
    if (request()->ajax()) {
        return DataTables::of($expensesQuery)
            ->addIndexColumn() // Adds a sequential index column
            ->addColumn('created_at_read', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('expense_head', function ($row) {
                return $row->expense_head_name;
            })
            ->addColumn('amount', function ($row) {
                return $row->amount . " TK";
            })
            ->addColumn('date', function ($row) {
                $date = $row->date ? new Carbon($row->date) : null;
                return $date ? $date->format("d-m-Y") : 'N/A';
            })
            ->addColumn('actions', function ($row) {
                $delete_api = route('expenses.destroy', $row);
                $edit_api = route('expenses.edit', $row);
                $csrf = csrf_token();
                $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                    <input name='_method' type='hidden' value='DELETE'>
                    <input name='_token' type='hidden' value='$csrf'>";

                if (auth()->user()->can('expense_edit')) {
                    $action .= "<a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='Edit expense details' href='$edit_api'>
                        <i class='ri-edit-box-fill'></i>
                    </a>";
                }

                if (auth()->user()->can('expense_delete')) {
                    $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='Delete expense'>
                        <i class='ri-delete-bin-fill'></i>
                    </button>";
                }

                $action .= "</form>";
                $action .= "<button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                    <i class='ri-eye-fill'></i>
                </button>";

                return $action;
            })
            ->rawColumns(['created_at_read', 'actions', 'expense_head'])
            ->make(true);
    }

    $totalAmount = $filteredExpenses->sum('amount');
    // Return the view with filtered expenses, total amount, and expense heads data
    return view('admin.expenses.expense_report', compact('expenseHeads', 'totalAmount'));
}


    /**
     * Show the form for creating a new expense.
     */
    public function create()
    {
        $expenseHeads = ExpenseHead::all();
        return view('admin.expenses.create', compact('expenseHeads'));
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_head_id' => 'required|exists:expense_heads,id',
            'name' => 'required|string|max:255',
            'invoice_no' => 'required|string|max:255|unique:expenses,invoice_no',
            'date' => 'required|date_format:d-m-Y',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:500',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // 512 KB
        ]);

        $expense = Expense::create([
            'expense_head_id' => $request->expense_head_id,
            'name' => $request->name,
            'invoice_no' => $request->invoice_no,
            'date' => Carbon::createFromFormat('d-m-Y', $request->date) ,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);

        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');

            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                ExpenseAttachment::create([
                    'expense_id' => $expense->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $fileNameToStore,
                    'file_type' => $extension, // Add this field to the database
                ]);
            }
        }
        return response()->json(['success' => "Expense created Successfully"]);
    }

    /**
     * Show the form for editing the specified expense.
     */


    public function edit(Expense $expense)
    {
        $expenseHeads = ExpenseHead::all();
        $attachments = $expense->attachments()->get();
        return view('admin.expenses.edit', compact('expense', 'expenseHeads', 'attachments'));
    }

    /**
     * Update the specified expense in storage.
     */
    // public function update(Request $request, Expense $expense)
    // {
    //     $request->validate([
    //         'expense_head_id' => 'required|exists:expense_heads,id',
    //         'name' => 'required|string|max:255',
    //         'invoice_no' => 'required|string|max:255|unique:expenses,invoice_no,' . $expense->id,
    //         'date' => 'required|date_format:d-m-Y',
    //         'amount' => 'required|numeric|min:0',
    //         'note' => 'nullable|string|max:500',
    //         'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // 512 KB
    //         'delete_attachments' => 'array', // IDs of attachments to delete
    //         'delete_attachments.*' => 'integer|exists:expense_attachments,id',
    //     ]);

    //     // Update expense data
    //     $expense->update([
    //         'expense_head_id' => $request->expense_head_id,
    //         'name' => $request->name,
    //         'invoice_no' => $request->invoice_no,
    //         'date' => Carbon::createFromFormat('d-m-Y', $request->date),
    //         'amount' => $request->amount,
    //         'note' => $request->note,
    //     ]);


    //     // Handle deletion of attachments
    //     if ($request->has('delete_attachments')) {
    //         $attachmentsToDelete = ExpenseAttachment::whereIn('id', $request->delete_attachments)->get();

    //         foreach ($attachmentsToDelete as $attachment) {
    //             // Delete the file from storage
    //             if (file_exists(public_path('assets/attachements/' . $attachment->file_path))) {
    //                 unlink(public_path('assets/attachements/' . $attachment->file_path));
    //             }

    //             // Delete the record from database
    //             $attachment->delete();
    //         }
    //     }

    //     // Handle new attachments
    //     if ($request->hasFile('attachments')) {
    //         foreach ($request->file('attachments') as $file) {
    //             $filenameWithExt = $file->getClientOriginalName();
    //             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //             $extension = $file->getClientOriginalExtension();
    //             $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    //             $file->move(public_path('assets/attachements'), $fileNameToStore);

    //             ExpenseAttachment::create([
    //                 'expense_id' => $expense->id,
    //                 'file_path' => $fileNameToStore,
    //                 'file_name' => $filenameWithExt,
    //                 'file_type' => $extension
    //             ]);
    //         }
    //     }

    //     return response()->json(['success' => "Expense updated successfully"]);
    // }
    public function update(Request $request, Expense $expense)
{
    $request->validate([
        'expense_head_id' => 'required|exists:expense_heads,id',
        'name' => 'required|string|max:255',
        'invoice_no' => 'required|string|max:255|unique:expenses,invoice_no,' . $expense->id,  // Fix the validation here
        'date' => 'required|date_format:d-m-Y',
        'amount' => 'required|numeric|min:0',
        'note' => 'nullable|string|max:500',
        'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // 512 KB
        'delete_attachments' => 'array', // IDs of attachments to delete
        'delete_attachments.*' => 'integer|exists:expense_attachments,id',
    ]);

    // Update expense data
    $expense->update([
        'expense_head_id' => $request->expense_head_id,
        'name' => $request->name,
        'invoice_no' => $request->invoice_no,
        'date' => Carbon::createFromFormat('d-m-Y', $request->date),
        'amount' => $request->amount,
        'note' => $request->note,
    ]);

    // Handle deletion of attachments
    if ($request->has('delete_attachments')) {
        $attachmentsToDelete = ExpenseAttachment::whereIn('id', $request->delete_attachments)->get();

        foreach ($attachmentsToDelete as $attachment) {
            // Delete the file from storage
            if (file_exists(public_path('assets/attachements/' . $attachment->file_path))) {
                unlink(public_path('assets/attachements/' . $attachment->file_path));
            }

            // Delete the record from database
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

            ExpenseAttachment::create([
                'expense_id' => $expense->id,
                'file_path' => $fileNameToStore,
                'file_name' => $filenameWithExt,
                'file_type' => $extension
            ]);
        }
    }

    return response()->json(['success' => "Expense updated successfully"]);
}


    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Expense $expense)
    {
        // Delete all attachments
        foreach ($expense->attachments as $attachment) {
            if (file_exists(public_path('assets/attachments/' . $attachment->file_path))) {
                unlink(public_path('assets/attachments/' . $attachment->file_path));
            }
        }

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }

    public function getAttachments(Expense $expense)
    {
        $attachments = $expense->attachments()->get(['file_path', 'file_name', 'file_type']);

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
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);

        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y',$request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
        $expense_head_id = $request->input('expense_head_id');

        // Format for the filename to include date range
        $filename = 'expense';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate . '_to_' . $toDate;
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate;
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate;
        }
        $filename .= '.xlsx';

        return Excel::download(new ExpensesExport($fromDate, $toDate,$expense_head_id), $filename);
    }

    // Export to PDF
    public function exportPDF(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y',$request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
        $expense_head_id = $request->input('expense_head_id');

        // Build the query with necessary joins and filters
        $query  = Expense::with('expenseHead')
            ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
            ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
            ->latest();

        // Apply date filters
        if ($fromDate && $toDate) {
            $query->whereDate('expenses.date', '>=', $fromDate)
                ->whereDate('expenses.date', '<=', $toDate);
        } elseif ($fromDate) {
            $query->whereDate('expenses.date', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('expenses.date', '<=', $toDate);
        }

        if ($expense_head_id) {
            $query->where('expenses.expense_head_id', $expense_head_id);
        }

        $expenses = $query->get();

        // Format for the filename to include date range
        $filename = 'expense';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate . '_to_' . $toDate;
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate;
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate;
        }
        $filename .= '.pdf';

        $pdf = Pdf::loadView('admin.expenses.export_pdf', [
            'expenses' => $expenses,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }
}
