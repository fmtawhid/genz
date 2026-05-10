@extends('admin.layout.layout')

@section('content')

<main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">

            <div>

                <h2 class="text-3xl font-bold text-gray-800">
                    Course Details
                </h2>

                <p class="text-gray-500 mt-1">
                    Course information and enrolled students
                </p>

            </div>

            <a href="{{ route('admin.courses.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg">

                Back

            </a>

        </div>

        <!-- Course Info -->
        <div class="bg-white rounded-2xl shadow p-8 mb-8">

            <div class="grid lg:grid-cols-3 gap-8">

                <!-- Image -->
                <div>

                    @if($course->thumbnail)

                        <img src="{{ asset($course->thumbnail) }}"
                             class="w-full rounded-2xl shadow">

                    @endif

                </div>

                <!-- Content -->
                <div class="lg:col-span-2">

                    <div class="flex items-center gap-3 flex-wrap mb-5">

                        <span class="px-4 py-1 rounded-full bg-primary-100 text-primary-700 text-sm">

                            {{ ucfirst($course->level) }}

                        </span>

                        <span class="px-4 py-1 rounded-full
                            {{ $course->status == 1
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700' }} text-sm">

                            {{ $course->status == 1 ? 'Active' : 'Inactive' }}

                        </span>

                    </div>

                    <h1 class="text-4xl font-bold text-gray-800 mb-5">

                        {{ $course->title }}

                    </h1>

                    <p class="text-gray-600 leading-relaxed">

                        {{ $course->description }}

                    </p>

                    <!-- Meta -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-8">

                        <div class="bg-gray-50 p-5 rounded-xl">

                            <h4 class="font-bold text-2xl">
                                ৳{{ number_format($course->price) }}
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Price
                            </p>

                        </div>

                        <div class="bg-gray-50 p-5 rounded-xl">

                            <h4 class="font-bold text-2xl">
                                {{ $course->duration }}
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Duration
                            </p>

                        </div>

                        <div class="bg-gray-50 p-5 rounded-xl">

                            <h4 class="font-bold text-2xl">
                                {{ $course->lessons->count() }}
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Lessons
                            </p>

                        </div>

                        <div class="bg-gray-50 p-5 rounded-xl">

                            <h4 class="font-bold text-2xl">
                                {{ $course->admissions->count() }}
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Students
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Students -->
        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex items-center justify-between mb-8">

                <div>

                    <h3 class="text-2xl font-bold">
                        Joined Students
                    </h3>

                    <p class="text-gray-500 text-sm mt-1">
                        All students enrolled in this course
                    </p>

                </div>

            </div>

            @if($course->admissions->count())

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-4 text-left">Student</th>

                                <th class="p-4 text-left">Phone</th>

                                <th class="p-4 text-left">Status</th>

                                <th class="p-4 text-left">Joined Date</th>

                                <th class="p-4 text-left">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($course->admissions as $admission)

                                <tr class="border-b">

                                    <!-- Student -->
                                    <td class="p-4">

                                        <div>

                                            <h4 class="font-semibold">

                                                {{ $admission->name }}

                                            </h4>

                                            <p class="text-sm text-gray-500">

                                                {{ $admission->email }}

                                            </p>

                                        </div>

                                    </td>

                                    <!-- Phone -->
                                    <td class="p-4">

                                        {{ $admission->phone }}

                                    </td>

                                    <!-- Status -->
                                    <td class="p-4">

                                        <span class="px-3 py-1 rounded-full text-xs
                                            @if($admission->status == 'approved')
                                                bg-green-100 text-green-700
                                            @elseif($admission->status == 'rejected')
                                                bg-red-100 text-red-700
                                            @else
                                                bg-yellow-100 text-yellow-700
                                            @endif">

                                            {{ ucfirst($admission->status) }}

                                        </span>

                                    </td>

                                    <!-- Date -->
                                    <td class="p-4 text-gray-500">

                                        {{ $admission->created_at->format('d M Y') }}

                                    </td>

                                    <!-- Action -->
                                    <td class="p-4">

                                        @if($admission->merchant)

                                            <a href="{{ route('admin.merchant.show', $admission->merchant->id) }}"
                                               class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm">

                                                View Student

                                            </a>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-16">

                    <i class="fas fa-users text-gray-300 text-6xl mb-5"></i>

                    <h3 class="text-2xl font-bold text-gray-700">
                        No Students Joined Yet
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Students who enroll in this course will appear here.
                    </p>

                </div>

            @endif

        </div>

    </div>

</main>

@endsection