<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use DataTables;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
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
            'permission:gallery_view' => ['index'],
            'permission:gallery_add' => ['create', 'store'],
            'permission:gallery_edit' => ['edit', 'update'],
            'permission:gallery_delete' => ['destroy'],
        ];
    }


    // // Display all gallery items
    // public function index()
    // {
    //     // $products = Product::latest()->get();
    //     $galleries = Gallery::latest()->get();
    //     if (request()->ajax()) {
    //         return DataTables::of($galleries)
    //             ->addIndexColumn()
    //             ->addColumn('created_at_read', function ($row) {
    //                 return $row->created_at->diffForHumans();
    //             })
    //             ->addColumn('actions', function ($row) {
    //                 $delete_api = route('gallery.destroy', $row);
    //                 $edit_api = route('gallery.edit', $row);
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
    //     return view('admin.gallery.index', compact('galleries'));
    // }

    // Display all gallery items
    public function index()
    {
        $galleries = Gallery::latest()->get();

        if (request()->ajax()) {
            return DataTables::of($galleries)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('gallery.destroy', $row);
                    $edit_api = route('gallery.edit', $row);
                    $csrf = csrf_token();

                    // Start the form for the delete button
                    $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                    <input name='_method' type='hidden' value='DELETE'>
                    <input name='_token' type='hidden' value='$csrf'>";

                    // Add Edit Button if the user has the 'gallery_edit' permission
                    if (auth()->user()->can('gallery_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' data-toggle='tooltip' title='Edit'
                        href='$edit_api'>
                        <i class='ri-edit-box-fill'></i>
                    </a>";
                    }

                    // Add Delete Button if the user has the 'gallery_delete' permission
                    if (auth()->user()->can('gallery_delete')) {
                        $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' title='Delete'>
                        <i class='ri-delete-bin-fill'></i>
                    </button>";
                    }

                    // Close the form tag
                    $action .= "</form>";

                    return $action;
                })
                ->rawColumns(['created_at_read', 'actions']) // Make sure action buttons are rendered as raw HTML
                ->make(true);
        }

        return view('admin.gallery.index', compact('galleries'));
    }



    // Show the form to create a new gallery item
    public function create()
    {
        return view('admin.gallery.create');
    }

    // Store a new gallery item
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'note' => 'nullable|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img/galleries'), $imageName);

        $gallery = new Gallery();

        $gallery->note = $request->note;
        $gallery->date = $request->date;
        $gallery->image = $imageName;
        $gallery->save();
        // Redirect with a success message
        return redirect()->route('gallery.list')->with('success', 'Gallery item created successfully!');
    }

    // Show the form to edit an existing gallery item
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    // Update an existing gallery item
    public function update(Request $request, $id)
    {


        // Validate the form data
        $request->validate([
            'note' => 'nullable|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);



        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img/galleries'), $imageName);

        $gallery = Gallery::findOrFail($id);

        $gallery->note = $request->note;
        $gallery->date = $request->date;
        $gallery->image = $imageName;
        $gallery->save();


        return redirect()->route('gallery.list')->with('success', 'Gallery item updated successfully!');
    }

    // Delete an existing gallery item
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete the image if exists
        if ($gallery->image) {
            Storage::delete($gallery->image);
        }

        // Delete the gallery item from database
        $gallery->delete();

        return redirect()->route('gallery.list')->with('success', 'Gallery item deleted successfully!');
    }
}