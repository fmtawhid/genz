<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sreni;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class SreniController extends Controller
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
            'permission:sreni_view' => ['index'],
            'permission:sreni_add' => ['create', 'store'],
            'permission:sreni_edit' => ['edit', 'update'],
            'permission:sreni_delete' => ['destroy'],
        ];
    }


    // public function index()
    // {
    //     // $products = Product::latest()->get();
    //     $srenis = Sreni::latest()->get();
    //     if (request()->ajax()) {
    //         return DataTables::of($srenis)
    //             ->addIndexColumn()
    //             ->addColumn('created_at_read', function ($row) {
    //                 return $row->created_at->diffForHumans();
    //             })
    //             ->addColumn('actions', function ($row) {
    //                 $delete_api = route('srenis.destroy', $row);
    //                 $edit_api = route('srenis.edit', $row);
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
    //     return view('admin.class.index', compact('srenis'));
    // }
    public function getSrenisByBibag($bibagId)
    {
        // Fetch all Srenis that belong to the selected Bibag
        $srenis = Sreni::where('bibag_id', $bibagId)->get();

        // Return the Srenis as a JSON response
        return response()->json([
            'srenis' => $srenis
        ]);
    }
    public function index()
    {
        // Retrieve all srenis
        $srenis = Sreni::latest()->get();

        if (request()->ajax()) {
            return DataTables::of($srenis)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('srenis.destroy', $row);
                    $edit_api = route('srenis.edit', $row);
                    $csrf = csrf_token();

                    // Start the form for the delete button
                    $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                    <input name='_method' type='hidden' value='DELETE'>
                    <input name='_token' type='hidden' value='$csrf'>";

                    // Add Edit Button if the user has the 'sreni_edit' permission
                    if (auth()->user()->can('sreni_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit sreni details'>
                        <i class='ri-edit-box-fill'></i>
                    </a>";
                    }

                    // Add Delete Button if the user has the 'sreni_delete' permission
                    if (auth()->user()->can('sreni_delete')) {
                        $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' title='Delete sreni'>
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

        return view('admin.class.index', compact('srenis'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        $sreni = new Sreni();

        $sreni->name = $request->name;

        $sreni->save();

        return redirect()->back()->with('success', "Class Added Successful");
    }

    public function edit(Sreni $sreni)
    {
        return view('admin.class.edit', compact('sreni'));
    }


    public function update(Request $request, Sreni $sreni)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sreni->update([
            'name' => $request->name
        ]);

        return redirect()->route('srenis.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(Sreni $sreni)
    {
        // Check if the Expense Head has any associated Expenses
        // if ($sreni->students()->exists()) {
        //     // Redirect back with an error message if Expenses exist
        //     return redirect()->back()
        //                      ->with('error', 'Cannot delete Class because it is associated with existing Student.');
        // }

        $hasStudents = DB::table('students')
            ->where('sreni_id', $sreni->id)
            ->exists();

        if ($hasStudents) {
            // Redirect back with an error message if Students exist
            return redirect()->back()
                ->with('error', 'Cannot delete Class because it is associated with existing Students.');
        }

        // If no associated Expenses, proceed to delete
        $sreni->delete();

        // Redirect back with a success message
        return redirect()->back()
            ->with('success', 'Class deleted successfully.');
    }
}
