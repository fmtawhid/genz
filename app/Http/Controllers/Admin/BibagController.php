<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bibag;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class BibagController extends Controller
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
            'permission:bibag_view' => ['index'],
            'permission:bibag_add' => ['create', 'store'],
            'permission:bibag_edit' => ['edit', 'update'],
            'permission:bibag_delete' => ['destroy'],
        ];
    }
    // public function index()
    // {
    //     // $products = Product::latest()->get();
    //     $bibags = Bibag::latest()->get();
    //     if (request()->ajax()) {
    //         return DataTables::of($bibags)
    //             ->addIndexColumn()
    //             ->addColumn('created_at_read', function ($row) {
    //                 return $row->created_at->diffForHumans();
    //             })
    //             ->addColumn('actions', function ($row) {
    //                 $delete_api = route('bibags.destroy', $row);
    //                 $edit_api = route('bibags.edit', $row);
    //                 // $seo_api = route('product_seos.create', $row->id);
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

    //             CODE;

    //                 return $action;
    //             })
    //             ->rawColumns(['created_at_read', 'actions'])
    //             ->make(true);
    //     }
    //     return view('admin.bibag.index', compact('bibags'));
    // }

    public function index()
    {
        // Fetch Bibags from the database
        $bibags = Bibag::latest()->get();

        // Check if the request is an AJAX call
        if (request()->ajax()) {
            return DataTables::of($bibags)
                ->addIndexColumn() // Adds a sequential index column
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('bibags.destroy', $row);
                    $edit_api = route('bibags.edit', $row);
                    $csrf = csrf_token();
                    $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>";

                    // Add Edit Button if the user has the 'bibag_edit' permission
                    if (auth()->user()->can('bibag_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' data-toggle='tooltip' title='Edit bibag details' href='$edit_api'>
                            <i class='ri-edit-box-fill'></i>
                        </a>";
                    }

                    // Add Delete Button if the user has the 'bibag_delete' permission
                    if (auth()->user()->can('bibag_delete')) {
                        $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' title='Delete bibag'>
                            <i class='ri-delete-bin-fill'></i>
                        </button>";
                    }

                    // Close the form tag
                    $action .= "</form>";

                    return $action;
                })
                ->rawColumns(['created_at_read', 'actions']) // Render 'actions' column as raw HTML
                ->make(true);
        }

        // Return the view with bibags data
        return view('admin.bibag.index', compact('bibags'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bibag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        $bibag = new Bibag();

        $bibag->name = $request->name;

        $bibag->save();

        return redirect()->back()->with('success', "Bibag Added Successful");
    }

    public function edit(Bibag $bibag)
    {
        return view('admin.bibag.edit', compact('bibag'));
    }


    public function update(Request $request, Bibag $bibag)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bibag->update([
            'name' => $request->name
        ]);

        return redirect()->route('bibags.index')->with('success', 'Bibag updated successfully.');
    }

    public function destroy(Bibag $bibag)
    {
        // Check if the Expense Head has any associated Expenses
        // if ($sreni->students()->exists()) {
        //     // Redirect back with an error message if Expenses exist
        //     return redirect()->back()
        //                      ->with('error', 'Cannot delete Class because it is associated with existing Student.');
        // }

        $hasStudents = DB::table('students')
            ->where('bibag_id', $bibag->id)
            ->exists();

        if ($hasStudents) {
            // Redirect back with an error message if Students exist
            return redirect()->back()
                ->with('error', 'Cannot delete Bibag because it is associated with existing Students.');
        }

        $hasPayments = DB::table('payments')
            ->where('bibag_id', $bibag->id)
            ->exists();

        if ($hasPayments) {
            // Redirect back with an error message if Students exist
            return redirect()->back()
                ->with('error', 'Cannot delete Bibag because it is associated with existing Payment.');
        }

        // If no associated Expenses, proceed to delete
        $bibag->delete();

        // Redirect back with a success message
        return redirect()->back()
            ->with('success', 'Bibag deleted successfully.');
    }
}
