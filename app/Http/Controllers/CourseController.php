<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'permission:course_view'   => ['index'],
            'permission:course_add'    => ['create', 'store'],
            'permission:course_edit'   => ['edit', 'update'],
            'permission:course_delete' => ['destroy'],
        ];
    }

    // ===================== Index =====================
    public function index()
    {
        if (request()->ajax()) {
            // N+1 এড়াতে eager load
            $courses = Course::with(['teachers:id,name', 'topics:id,name'])
                ->latest()
                ->get();

            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('teachers', function($row) {
                    return $row->teachers->pluck('name')->implode(', ');
                })
                ->addColumn('topics', function($row) {
                    return $row->topics->pluck('name')->implode(', ');
                })
                ->addColumn('image', function($row) {
                    if ($row->image && file_exists(public_path('uploads/courses/'.$row->image))) {
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

                    if (auth()->user()->can('course_edit')) {
                        $buttons .= "<a href='$edit' class='btn btn-info btn-sm m-1'>Edit</a>";
                    }
                    if (auth()->user()->can('course_delete')) {
                        $buttons .= "<button type='submit' class='btn btn-danger btn-sm m-1' onclick=\"return confirm('Delete this course?');\">Delete</button>";
                    }
                    $buttons .= "</form>";

                    return $buttons;
                })
                ->rawColumns(['actions', 'image'])
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
            'title'               => 'required|string',
            'slug'                => 'required|string|unique:courses,slug',
            'price'               => 'required|numeric',
            'duration'            => 'required|string',
            'teachers'            => 'required|array',
            'teachers.*'          => 'exists:teachers,id',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description'   => 'nullable|string',
            'long_description'    => 'nullable|string',
            'new_topics'          => 'nullable|array',
            'new_topics.*.name'   => 'nullable|string',
            'new_topics.*.note'   => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            // Handle image
            $imageName = $this->uploadCourseImage($request);

            // Create course
            $course = Course::create([
                'title'              => $request->title,
                'slug'               => $request->slug,
                'price'              => $request->price,
                'duration'           => $request->duration,
                'short_description'  => $request->short_description,
                'long_description'   => $request->long_description,
                'image'              => $imageName,
            ]);

            // Sync teachers
            $course->teachers()->sync($request->teachers);

            // Topics (firstOrNew => note নিশ্চিতভাবে save/update)
            $topicIds = [];
            if ($request->filled('new_topics')) {
                foreach ($request->new_topics as $topicData) {
                    $name = trim($topicData['name'] ?? '');
                    $note = trim($topicData['note'] ?? '');

                    if ($name !== '') {
                        $topic = Topic::firstOrNew(['name' => $name]);
                        $topic->note = $note; // overwrite/assign always
                        $topic->save();

                        $topicIds[] = $topic->id;
                    }
                }
            }
            // store-এও exact তালিকা সেট করতে চাইলে sync ব্যবহার করুন
            $course->topics()->sync($topicIds);
        });

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    // ===================== Edit =====================
    public function edit(Course $course)
    {
        $allTeachers = Teacher::all();
        return view('admin.courses.edit', compact('course', 'allTeachers'));
    }

    // ===================== Update =====================
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title'               => 'required|string',
            'slug'                => 'required|string|unique:courses,slug,'.$course->id,
            'price'               => 'required|numeric',
            'duration'            => 'required|string',
            'teachers'            => 'required|array',
            'teachers.*'          => 'exists:teachers,id',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description'   => 'nullable|string',
            'long_description'    => 'nullable|string',
            'new_topics'          => 'nullable|array',
            'new_topics.*.name'   => 'nullable|string',
            'new_topics.*.note'   => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $course) {

            // Handle image (replace old)
            $newImage = $this->uploadCourseImage($request, $course->image);
            if ($newImage) {
                $course->image = $newImage;
            }

            // Update course basic fields
            $course->update([
                'title'             => $request->title,
                'slug'              => $request->slug,
                'price'             => $request->price,
                'duration'          => $request->duration,
                'short_description' => $request->short_description,
                'long_description'  => $request->long_description,
            ]);

            // Sync teachers
            $course->teachers()->sync($request->teachers);

            // Topics — exact set replace (empty হলে detach করে দেবে)
            $topicIds = [];
            if ($request->filled('new_topics')) {
                foreach ($request->new_topics as $topicData) {
                    $name = trim($topicData['name'] ?? '');
                    $note = trim($topicData['note'] ?? '');

                    if ($name !== '') {
                        $topic = Topic::firstOrNew(['name' => $name]);
                        $topic->note = $note; // force update
                        $topic->save();

                        $topicIds[] = $topic->id;
                    }
                }
            }
            $course->topics()->sync($topicIds);
        });

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    // ===================== Destroy =====================
    public function destroy(Course $course)
    {
        // detach relations first
        $course->teachers()->detach();
        $course->topics()->detach();

        // Delete image
        if ($course->image && file_exists(public_path('uploads/courses/'.$course->image))) {
            @unlink(public_path('uploads/courses/'.$course->image));
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

    // ===================== Helpers =====================
    /**
     * Handle image upload; delete old if provided.
     */
    private function uploadCourseImage(Request $request, ?string $existing = null): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        // delete old if exists
        if ($existing && file_exists(public_path('uploads/courses/'.$existing))) {
            @unlink(public_path('uploads/courses/'.$existing));
        }

        $file = $request->file('image');
        $imageName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/courses'), $imageName);

        return $imageName;
    }
}
