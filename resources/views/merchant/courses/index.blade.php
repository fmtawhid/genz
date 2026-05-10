@extends('merchant.layout.layout')

@section('content')

<main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-8">

            <h2 class="text-3xl font-bold text-gray-800">
                My Courses
            </h2>

            <p class="text-gray-600 mt-1">
                All your enrolled courses
            </p>

        </div>

        <!-- Alerts -->
        @if(session('success'))

            <div class="mb-5 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>

        @endif

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($admissions as $admission)

                @php
                    $course = $admission->course;
                @endphp

                @if($course)

                    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

                        <!-- Thumbnail -->
                        <div class="h-52 overflow-hidden bg-gray-100">

                            @if($course->thumbnail)

                                <img src="{{ asset($course->thumbnail) }}"
                                     class="w-full h-full object-cover hover:scale-105 transition duration-300">

                            @endif

                        </div>

                        <!-- Content -->
                        <div class="p-5">

                            <div class="flex items-center justify-between mb-3">

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

                                <span class="text-sm text-gray-500">
                                    {{ ucfirst($course->level) }}
                                </span>

                            </div>

                            <h3 class="text-xl font-bold text-gray-800 mb-2">

                                {{ $course->title }}

                            </h3>

                            <p class="text-gray-600 text-sm mb-5">

                                {{ \Illuminate\Support\Str::limit($course->description, 90) }}

                            </p>

                            <!-- Meta -->
                            <div class="space-y-2 text-sm text-gray-500 mb-5">

                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2 text-primary-600"></i>
                                    {{ $course->duration }}
                                </div>

                                <div class="flex items-center">
                                    <i class="fas fa-play-circle mr-2 text-primary-600"></i>
                                    {{ $course->lessons->count() }} Lessons
                                </div>

                            </div>

                            <!-- Button -->
                            <a href="{{ route('merchant.courses.show', $admission->id) }}"
                               class="block text-center w-full px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-semibold transition">

                                View Course

                            </a>

                        </div>

                    </div>

                @endif

            @empty

                <div class="col-span-full text-center py-20">

                    <i class="fas fa-book-open text-gray-300 text-6xl mb-5"></i>

                    <h3 class="text-2xl font-bold text-gray-700">
                        No Courses Joined Yet
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Your enrolled courses will appear here.
                    </p>

                </div>

            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-10">

            {{ $admissions->links() }}

        </div>

    </div>

</main>

@endsection