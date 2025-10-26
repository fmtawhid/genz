<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;




class NoticeController extends Controller
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
            'permission:notice_view' => ['index'],
            'permission:notice_add' => ['create', 'store'],
            'permission:notice_edit' => ['edit', 'update'],
            'permission:notice_delete' => ['destroy'],
        ];
    }
    
    public function index()
{
    $notices = Notice::latest()->get();
    if (request()->ajax()) {
        return DataTables::of($notices)
            ->addIndexColumn()
            ->addColumn('created_at_read', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('actions', function ($row) {
                $delete_api = route('notices.delete', $row);
                $edit_api = route('notices.edit', $row);
                $csrf = csrf_token();

                $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                    <input name='_method' type='hidden' value='DELETE'>
                    <input name='_token' type='hidden' value='$csrf'>";

                // Add Edit Button
                if (auth()->user()->can('notice_edit')) {
                    $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' data-toggle='tooltip' title='Edit'>
                        <i class='ri-edit-box-fill'></i>
                    </a>";
                }

                // Add Delete Button
                if (auth()->user()->can('notice_delete')) {
                    $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' title='Delete'>
                        <i class='ri-delete-bin-fill'></i>
                    </button>";
                }

                $action .= "</form>";
                
                return $action;
            })
            ->rawColumns(['created_at_read', 'actions'])
            ->make(true);
    }

    return view('admin.notice.index', compact('notices'));
}






    // Show the form for creating a new notice
    public function create()
    {
        return view('admin.notice.create'); // Adjust view path for 'create' form
    }

    // Store a newly created notice in storage
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'section_title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date_format:d-m-Y',
            'pdf_file' => 'nullable|mimes:pdf|max:2048', // Validate PDF file (2MB max size)
        ]);

        // Handle PDF file upload (store in the same location as gallery images)
        $pdfFilePath = null;
        if ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');

            $pdfFilePath = time() . '.' . $pdfFile->extension();
            $pdfFile->move(public_path('img/notice_pdf'), $pdfFilePath); // Store in 'public/img/galleries'
        }

        // Create a new notice
        $notice = new Notice();
        $notice->section_title = $request->section_title;
        $notice->description = $request->description;
        $notice->date = Carbon::createFromFormat('d-m-Y', $request->date);
        $notice->pdf_file = $pdfFilePath; // Save the PDF file path

        // Save the notice
        $notice->save();

        // Redirect with a success message
        return redirect()->route('notices.list')->with('success', 'Notice created successfully');
    }

    public function destroy($id)
    {
        // Find the notice by its ID
        $notice = Notice::findOrFail($id);

        // Delete the notice
        $notice->delete();

        // Redirect back to the list with a success message
        return redirect()->route('notices.list')->with('success', 'Notice deleted successfully');
    }
    public function edit($id)
    {
        // Find the notice by its ID
        $notice = Notice::findOrFail($id);

        // Return the edit view with the notice data
        return view('admin.notice.edit', compact('notice'));
    }
    public function update(Request $request, $id)
    {
        // Find the notice by its ID
        $notice = Notice::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'section_title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'pdf_file' => 'nullable|mimes:pdf|max:2048', // Validate PDF file (2MB max size)
        ]);

        // Handle PDF file upload
        if ($request->hasFile('pdf_file')) {
            // Optional: Delete the old file
            if ($notice->pdf_file && file_exists(public_path('pdf_files/' . $notice->pdf_file))) {
                unlink(public_path('pdf_files/' . $notice->pdf_file));
            }

            // Generate a new file name for the PDF
            $pdfName = time() . '.' . $request->pdf_file->extension();

            // Move the file to the 'public/pdf_files' directory
            $request->pdf_file->move(public_path('pdf_files'), $pdfName);

            // Save the file path in the database
            $notice->pdf_file = 'pdf_files/' . $pdfName;
        }


        // Update other notice data
        $notice->section_title = $request->section_title;
        $notice->description = $request->description;
        $notice->date = $request->date;

        // Save the updated notice
        $notice->save();

        // Redirect to the notices list page with a success message
        return redirect()->route('notices.list')->with('success', 'Notice updated successfully');
    }




}
