@extends('merchant.layout.layout')

@section('content')

<main class="flex-1 overflow-y-auto bg-gray-50">

    @php
        $course = $admission->course;
    @endphp

    <!-- HERO -->
    <section class="bg-white border-b">

        <div class="max-w-7xl mx-auto px-4 py-10">

            <div class="grid lg:grid-cols-2 gap-10 items-center">

                <div>

                    <span class="inline-flex items-center px-4 py-1 rounded-full
                        @if($admission->status == 'approved')
                            bg-green-100 text-green-700
                        @elseif($admission->status == 'rejected')
                            bg-red-100 text-red-700
                        @else
                            bg-yellow-100 text-yellow-700
                        @endif">

                        {{ ucfirst($admission->status) }}

                    </span>

                    <h1 class="text-4xl font-bold text-gray-800 mt-5">

                        {{ $course->title }}

                    </h1>

                    <p class="text-gray-600 mt-5 leading-relaxed">

                        {{ $course->description }}

                    </p>

                    <div class="flex flex-wrap gap-4 mt-8">

                        <div class="px-4 py-3 bg-gray-100 rounded-xl">
                            <strong>{{ ucfirst($course->level) }}</strong>
                            <p class="text-sm text-gray-500">Level</p>
                        </div>

                        <div class="px-4 py-3 bg-gray-100 rounded-xl">
                            <strong>{{ $course->duration }}</strong>
                            <p class="text-sm text-gray-500">Duration</p>
                        </div>

                        <div class="px-4 py-3 bg-gray-100 rounded-xl">
                            <strong>{{ $course->lessons->count() }}</strong>
                            <p class="text-sm text-gray-500">Lessons</p>
                        </div>

                    </div>

                </div>

                <div>

                    @if($course->thumbnail)

                        <img src="{{ asset($course->thumbnail) }}"
                             class="w-full rounded-2xl shadow-xl">

                    @endif

                </div>

            </div>

        </div>

    </section>

    <!-- LESSONS -->
    <section class="max-w-7xl mx-auto px-4 py-12">

        <div class="flex items-center justify-between mb-8">

            <div>

                <h2 class="text-3xl font-bold text-gray-800">
                    Course Lessons
                </h2>

                <p class="text-gray-500 mt-1">
                    All available lessons in this course
                </p>

            </div>

        </div>

        <div class="space-y-5">

            @forelse($course->lessons->sortBy('order') as $lesson)

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                        <div class="flex gap-5">

                            <div class="w-14 h-14 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-lg">

                                {{ $loop->iteration }}

                            </div>

                            <div>

                                <div class="flex items-center gap-3 flex-wrap">

                                    <h3 class="text-xl font-semibold">

                                        {{ $lesson->title }}

                                    </h3>

                                    @if($lesson->is_free)

                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">

                                            Free Lesson

                                        </span>

                                    @endif

                                </div>

                                @if($lesson->description)

                                    <p class="text-gray-600 mt-2">

                                        {{ $lesson->description }}

                                    </p>

                                @endif

                            </div>

                        </div>

                        <div class="text-sm text-gray-500">

                            {{ $lesson->duration }}

                        </div>

                    </div>

                    <!-- Video -->
                    @if($lesson->video_url && $admission->status == 'approved')

                        <div class="mt-5">

                            <a href="{{ $lesson->video_url }}"
                               target="_blank"
                               class="inline-flex items-center px-5 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl transition">

                                <i class="fas fa-play mr-2"></i>

                                Watch Lesson

                            </a>

                        </div>

                    @elseif($admission->status != 'approved')

                        <div class="mt-5 p-4 bg-yellow-50 text-yellow-700 rounded-xl">

                            Your admission is pending approval.
                            Lesson access will unlock after approval.

                        </div>

                    @endif

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow p-10 text-center text-gray-500">

                    No lessons available yet

                </div>

            @endforelse

        </div>

    </section>

</main>

@endsection