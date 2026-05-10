<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /* ================= COURSE LIST ================= */

    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    /* ================= CREATE ================= */

    public function create()
    {
        return view('admin.courses.create');
    }

    /* ================= STORE ================= */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'thumbnail' => 'nullable|image',
            'level' => 'nullable|string',
            'duration' => 'nullable|integer',
            'status' => 'nullable|string',
            'lessons' => 'nullable|array',
            'lessons.*.title' => 'nullable|string|max:255',
            'lessons.*.description' => 'nullable|string',
            'lessons.*.video_url' => 'nullable|string',
            'lessons.*.duration' => 'nullable|integer',
            'lessons.*.order' => 'nullable|integer',
            'lessons.*.is_free' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($request->title);

        // IMAGE UPLOAD (SIMPLE WAY)
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);

            $validated['thumbnail'] = 'uploads/courses/' . $filename;
        }

        // Extract lessons array before creating course
        $lessonsData = $validated['lessons'] ?? [];
        unset($validated['lessons']);

        // Create course
        $course = Course::create($validated);

        // Create lessons if provided
        if (!empty($lessonsData)) {
            foreach ($lessonsData as $lessonData) {
                if (!empty($lessonData['title'])) { // Only create if title is provided
                    $lessonData['course_id'] = $course->id;
                    Lesson::create($lessonData);
                }
            }
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course and lessons created successfully');
    }

    /* ================= EDIT ================= */

    public function edit($id)
    {
        $course = Course::with('lessons')->findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    /* ================= UPDATE ================= */

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'thumbnail' => 'nullable|image',
            'level' => 'nullable|string',
            'duration' => 'nullable|integer',
            'status' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($request->title);

        // IMAGE UPDATE (simple delete + upload)
        if ($request->hasFile('thumbnail')) {

            if ($course->thumbnail && file_exists(public_path($course->thumbnail))) {
                unlink(public_path($course->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);

            $validated['thumbnail'] = 'uploads/courses/' . $filename;
        }

        $course->update($validated);

        return redirect()->back()
            ->with('success', 'Course updated successfully');
    }

    /* ================= DELETE ================= */

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->thumbnail && file_exists(public_path($course->thumbnail))) {
            unlink(public_path($course->thumbnail));
        }

        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully');
    }

    /* ================= LESSON (INSIDE COURSE) ================= */

    public function storeLesson(Request $request, $courseId)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string',
            'content' => 'nullable|string',
            'duration' => 'nullable|integer',
            'order' => 'nullable|integer',
            'is_free' => 'nullable|boolean',
        ]);

        $validated['course_id'] = $courseId;

        Lesson::create($validated);

        return redirect()->back()->with('success', 'Lesson created successfully');
    }

    public function updateLesson(Request $request, $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string',
            'content' => 'nullable|string',
            'duration' => 'nullable|integer',
            'order' => 'nullable|integer',
            'is_free' => 'nullable|boolean',
        ]);

        $lesson->update($validated);

        return redirect()->back()->with('success', 'Lesson updated successfully');
    }

    public function deleteLesson($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $lesson->delete();

        return redirect()->back()->with('success', 'Lesson deleted successfully');
    }

    public function show($id)
    {
        $course = Course::with([
            'lessons',
            'admissions.merchant',
            'admissions.user'
        ])->findOrFail($id);

        return view('admin.courses.show', compact('course'));
    }
}