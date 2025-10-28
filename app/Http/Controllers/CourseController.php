<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Teacher;
use DataTables;

class CourseController extends Controller
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
            'permission:course_view' => ['index'],
            'permission:course_add' => ['create', 'store'],
            'permission:course_edit' => ['edit', 'update'],
            'permission:course_delete' => ['destroy'],
        ];
    }

    // ===================== Index =====================
    public function index()
    {
        if (request()->ajax()) {
            $courses = Course::latest()->get();
            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('teachers', function($row) {
                    return $row->teachers->pluck('name')->implode(', ');
                })
                ->addColumn('topics', function($row) {
                    return $row->topics->pluck('name')->implode(', ');
                })
                ->addColumn('image', function($row) {
                    if($row->image && file_exists(public_path('uploads/courses/'.$row->image))){
                        return '<img src="'.asset('uploads/courses/'.$row->image).'" width="50" height="50" style="object-fit:cover;">';
                    }
                    return '<img src="https://via.placeholder.com/50" width="50" height="50">';
                })
                ->addColumn('actions', function ($row) {
                    $edit = route('courses.edit', $row->id);
                    $destroy = route('courses.destroy', $row->id);
                    $csrf = csrf_token();
                    $buttons = "<form method='POST' action='$destroy' class='d-inline-block'>
                                    <input type='hidden' name='_token' value='$csrf'>
                                    <input type='hidden' name='_method' value='DELETE'>";
                    if(auth()->user()->can('course_edit')){
                        $buttons .= "<a href='$edit' class='btn btn-info btn-sm m-1'>Edit</a>";
                    }
                    if(auth()->user()->can('course_delete')){
                        $buttons .= "<button type='submit' class='btn btn-danger btn-sm m-1'>Delete</button>";
                    }
                    $buttons .= "</form>";
                    return $buttons;
                })
                ->rawColumns(['actions','image'])
                ->make(true);
        }

        return view('admin.courses.index');
    }

    // ===================== Create =====================
    public function create()
    {
        $allTeachers = Teacher::all();
        return view('admin.courses.create', compact('allTeachers'));
    }

    // ===================== Store =====================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:courses,slug',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'teachers' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'new_topics' => 'nullable|array',
            'new_topics.*.name' => 'nullable|string',
            'new_topics.*.note' => 'nullable|string',
        ]);

        // Handle image
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/courses'), $imageName);
        }

        $course = Course::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'duration' => $request->duration,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image' => $imageName,
        ]);

        // Attach teachers
        $course->teachers()->sync($request->teachers);

        // Add topics
        if($request->new_topics){
            foreach($request->new_topics as $topicData){
                $name = trim($topicData['name'] ?? '');
                $note = trim($topicData['note'] ?? '');
                if($name){
                    $topic = Topic::updateOrCreate(
                        ['name' => $name],
                        ['note' => $note]
                    );
                    $course->topics()->syncWithoutDetaching($topic->id);
                }
            }
        }

        return redirect()->route('courses.index')->with('success','Course created successfully!');
    }

    // ===================== Edit =====================
    public function edit(Course $course)
    {
        $allTeachers = Teacher::all();
        return view('admin.courses.edit', compact('course','allTeachers'));
    }

    // ===================== Update =====================
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:courses,slug,'.$course->id,
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'teachers' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'new_topics' => 'nullable|array',
            'new_topics.*.name' => 'nullable|string',
            'new_topics.*.note' => 'nullable|string',
        ]);

        // Handle image
        if ($request->hasFile('image')) {
            if($course->image && file_exists(public_path('uploads/courses/'.$course->image))){
                unlink(public_path('uploads/courses/'.$course->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/courses'), $imageName);
            $course->image = $imageName;
        }

        $course->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'duration' => $request->duration,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ]);

        // Sync teachers
        $course->teachers()->sync($request->teachers);

        // Update topics
        $topicIds = [];
        if($request->new_topics){
            foreach($request->new_topics as $topicData){
                $name = trim($topicData['name'] ?? '');
                $note = trim($topicData['note'] ?? '');
                if($name){
                    $topic = Topic::updateOrCreate(
                        ['name' => $name],
                        ['note' => $note]
                    );
                    $topicIds[] = $topic->id;
                }
            }
        }

        // Sync topics with course
        $course->topics()->sync($topicIds);

        return redirect()->route('courses.index')->with('success','Course updated successfully!');
    }

    // ===================== Destroy =====================
    public function destroy(Course $course)
    {
        $course->teachers()->detach();
        $course->topics()->detach();

        // Delete image
        if($course->image && file_exists(public_path('uploads/courses/'.$course->image))){
            unlink(public_path('uploads/courses/'.$course->image));
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success','Course deleted successfully!');
    }
}
