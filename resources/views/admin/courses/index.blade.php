@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Courses</h2>

        <a href="{{ route('admin.courses.create') }}"
           class="px-4 py-2 bg-green-600 text-white rounded">
            + Add Course
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Image</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Level</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($courses as $key => $course)
                <tr class="border-b">
                    <td class="p-3">{{ $key + 1 }}</td>

                    <td class="p-3">
                        @if($course->thumbnail)
                            <img src="{{ asset($course->thumbnail) }}"
                                 class="w-12 h-12 rounded">
                        @endif
                    </td>

                    <td class="p-3">{{ $course->title }}</td>

                    <td class="p-3">${{ $course->price }}</td>

                    <td class="p-3">{{ $course->level }}</td>

                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.courses.edit', $course->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white rounded">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.courses.destroy', $course->id) }}">
                            @csrf
                            @method('DELETE')

                            <button class="px-3 py-1 bg-red-500 text-white rounded"
                                    onclick="return confirm('Delete?')">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</main>
@endsection