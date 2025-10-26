<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Teacher;
class UserController extends Controller
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
            'permission:user_view' => ['index'],
            'permission:user_add' => ['create', 'store'],
            'permission:user_edit' => ['edit', 'update'],
            'permission:user_delete' => ['destroy'],
        ];
    }

    // public function index()
    // {
    //     if (request()->ajax()) {
    //         $users = User::with('roles')->latest()->get();

    //         return DataTables::of($users)
    //             ->addIndexColumn()
    //             ->addColumn('created_at_read', function ($row) {
    //                 return $row->created_at->diffForHumans();
    //             })
    //             ->addColumn('roles', function ($row) {
    //                 // ইউজারের রোলের নাম গুলো কমা (,) দিয়ে দেখানো হবে
    //                 return $row->roles->pluck('name')->implode(', ');
    //             })
    //             ->addColumn('actions', function ($row) {
    //                 $delete_api = route('users.destroy', $row);
    //                 $edit_api = route('users.edit', $row);
    //                 $csrf = csrf_token();
    //                 return <<<HTML
    //                 <form method='POST' action='$delete_api' class='d-inline-block dform'>
    //                     <input name='_method' type='hidden' value='DELETE'>
    //                     <input name='_token' type='hidden' value='$csrf'>
    //                     <a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit user details'>
    //                         <i class="ri-edit-box-fill"></i>
    //                     </a>
    //                     <button type='submit' class='btn delete btn-danger btn-sm m-1'>
    //                         <i class="ri-delete-bin-fill"></i>
    //                     </button>
    //                 </form>
    //                 HTML;
    //             })
    //             ->rawColumns(['created_at_read', 'roles', 'actions'])
    //             ->make(true);
    //     }

    //     return view('admin.users.index');
    // }

    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles')->latest()->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return optional($row->created_at)->diffForHumans() ?? 'N/A';
                })
                
                // ->addColumn('roles', function ($row) {
                //     // Display user roles separated by commas
                //     return $row->roles->pluck('name')->implode(', ');
                // })
                ->addColumn('roles', function ($row) {
                    // Check if roles exist, if not fetch from the user table
                    $roles = $row->roles->pluck('name')->implode(', ');
            
                    // If no roles found, fetch the default role from the user table
                    if (empty($roles)) {
                        // Assuming 'role' is a column in the User model for a default role
                        return $row->role ?? 'No Role Assigned';
                    }
            
                    return $roles;
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('users.destroy', $row);
                    $edit_api = route('users.edit', $row);
                    $csrf = csrf_token();

                    // Start building the action buttons
                    $action = '';

                    // Add Edit Button if the user has the 'user_edit' permission
                    if (auth()->user()->can('user_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit user details'>
                                        <i class='ri-edit-box-fill'></i>
                                    </a>";
                    }

                    // Add Delete Button if the user has the 'user_delete' permission
                    if (auth()->user()->can('user_delete')) {
                        $action .= "<form method='POST' action='$delete_api' class='d-inline-block dform'>
                                        <input name='_method' type='hidden' value='DELETE'>
                                        <input name='_token' type='hidden' value='$csrf'>
                                        <button type='submit' class='btn delete btn-danger btn-sm m-1' title='Delete user'>
                                            <i class='ri-delete-bin-fill'></i>
                                        </button>
                                    </form>";
                    }

                    return $action;
                })
                ->rawColumns(['created_at_read', 'roles', 'actions'])
                ->make(true);
        }

        return view('admin.users.index');
    }


    /**
     * Show the form to create a new user.
     */
    public function create()
    {
        $roles = Role::all();
        $teachers = Teacher::whereNotNull('user_id')->get();
        return view('admin.users.create', compact('roles', 'teachers'));
    }

public function store(Request $request)
{
    // Validation rules
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        // 'role' validation is removed since it's hardcoded to 'admin'
        'roles' => 'nullable|array', // Role assignment
        'roles.*' => 'exists:roles,id', // Ensure the role IDs are valid
        'employee_id' => 'nullable|unique:users,employee_id|exists:teachers,user_id',
    ]);

    if ($validator->fails()) {
        return redirect()->route('users.create')->withErrors($validator)->withInput();
    }

    // Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'employee_id' => $request->employee_id,
        'password' => Hash::make($request->password),
        
        'role' => 'admin', // Hardcoding 'admin' role
    ]);

    // Sync roles if provided
    if ($request->has('roles') && !empty($request->roles)) {
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
        $user->syncRoles($roleNames);
    }

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $teachers = Teacher::whereNotNull('user_id')->get();
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles', 'teachers'));
    }



    public function update(Request $request, $id)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
            'employee_id' => 'nullable|unique:users,employee_id,' . $id . '|exists:teachers,user_id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
        }
    
        // Find the user
        $user = User::findOrFail($id);
    
        // Update basic fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->employee_id = $request->employee_id;
    
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Role is hardcoded to 'admin' like in store
        $user->role = 'admin';
    
        // Sync roles if provided
        if ($request->has('roles') && !empty($request->roles)) {
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }
    
        // Save changes
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    



    /**
     * Delete an existing user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }

    public function checkStudentDakhilaNumber(Request $request)
    {
        // Validate the input (dakhila number)
        $request->validate([
            'dakhila_number' => 'required|string|max:255',
        ]);

        // Find the student by Dakhila number
        $student = Student::where('dhakila_number', $request->dakhila_number)->first();

        // If student found, return success response, else return error
        if ($student) {
            return response()->json(['success' => true, 'student' => $student]);
        } else {
            return response()->json(['success' => false, 'message' => 'User ID not found']);
        }
    }

    public function changePassword()
    {
        return view('admin.users.change_password');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password without logging the user out
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }




    

    // For Create Student User

    public function showRegistrationForm()
    {
        return view('admin.users.student_register');
    }

    // public function fetchStudentName(Request $request)
    // {
    //     $student = Student::where('dhakila_number', $request->dhakila_number)->first();

    //     if ($student) {
    //         return response()->json(['success' => true, 'name' => $student->name]);
    //     }

    //     return response()->json(['success' => false, 'message' => 'No student found with this Dakhila Number']);
    // }
    public function fetchStudentName(Request $request)
{
    $student = Student::where('dhakila_number', $request->dhakila_number)->first();

    if ($student) {
        return response()->json([
            'success' => true,
            'name' => $student->student_name ?? 'No Name Found', // যদি name ফাঁকা থাকে তাহলে ডিফল্ট টেক্সট দেখাবে
            'raw_data' => $student // Debugging জন্য পুরো ডাটা ফেরত পাঠাচ্ছি
        ]);
    }

    return response()->json(['success' => false, 'message' => 'No student found with this User ID']);
}



public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'dhakila_number' => 'required|string|max:255|exists:students,dhakila_number|unique:users,student_dhakila_number',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $student = Student::where('dhakila_number', $request->dhakila_number)->first();

    if (!$student) {
        return redirect()->back()->withErrors(['dhakila_number' => 'Invalid Dakhila Number'])->withInput();
    }
 
    // Create User
    $user = User::create([
        'name' => $student->student_name,
        'email' => null, // Email is nullable
        'password' => Hash::make($request->password),
        'role' => 'student',
        'student_dhakila_number' => $request->dhakila_number,
    ]);

    return redirect()->back()->with('success', 'Account created successfully! You can now login.');
}




}
