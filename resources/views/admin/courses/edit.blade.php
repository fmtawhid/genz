@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">

    <h2 class="text-2xl font-bold mb-4">Edit Course</h2>

    {{-- COURSE UPDATE --}}
    <form method="POST"
          action="{{ route('admin.courses.update', $course->id) }}"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow mb-6">

        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $course->title }}"
               class="w-full p-2 border mb-3">

        <textarea name="description"
                  class="w-full p-2 border mb-3">{{ $course->description }}</textarea>

        <input type="number" name="price" value="{{ $course->price }}"
               class="w-full p-2 border mb-3">

        <input type="file" name="thumbnail"
               class="w-full p-2 border mb-3">

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Update Course
        </button>
    </form>

    {{-- LESSON CREATE --}}
    <div class="bg-white p-6 rounded shadow mb-6">

        <h3 class="text-xl font-bold mb-4">Add Lesson</h3>

        <form method="POST"
              action="{{ route('admin.courses.lessons.store', $course->id) }}">

            @csrf

            <input type="text" name="title" placeholder="Lesson Title"
                   class="w-full p-2 border mb-3">

            <textarea name="description" placeholder="Description"
                      class="w-full p-2 border mb-3"></textarea>

            <input type="text" name="video_url" placeholder="Video URL"
                   class="w-full p-2 border mb-3">

            <input type="number" name="order" placeholder="Order"
                   class="w-full p-2 border mb-3">

            <label>
                <input type="checkbox" name="is_free" value="1">
                Free Lesson
            </label>

            <button class="px-4 py-2 bg-green-600 text-white rounded mt-3">
                Add Lesson
            </button>

        </form>
    </div>

    {{-- LESSON LIST --}}
    <div class="bg-white p-6 rounded shadow">

        <h3 class="text-xl font-bold mb-4">Lessons</h3>

        @foreach($course->lessons as $lesson)
            <div class="p-3 border-b flex justify-between">

                <div>
                    <h4 class="font-bold">{{ $lesson->title }}</h4>
                    <p class="text-sm text-gray-500">{{ $lesson->description }}</p>
                </div>

                <form method="POST"
                      action="{{ route('admin.courses.lessons.destroy', $lesson->id) }}">

                    @csrf
                    @method('DELETE')

                    <button class="text-red-500">
                        Delete
                    </button>

                </form>

            </div>
        @endforeach

    </div>

</main>
@endsection