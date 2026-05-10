@extends('templates.layouts.master')

@section('body')

<!-- Course Hero -->
<section class="bg-gradient-to-r from-brand/5 to-white py-20">
    <div class="container mx-auto px-4 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

        <div>
            <span class="inline-flex items-center px-4 py-1 rounded-full bg-brand/10 text-brand text-sm font-medium mb-4">
                {{ ucfirst($course->level) }} Level Course
            </span>

            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                {{ $course->title }}
            </h1>

            <p class="mt-5 text-slate-600 max-w-2xl leading-relaxed">
                {{ $course->description }}
            </p>

            <div class="mt-8 flex flex-wrap gap-4">

                <a href="{{ route('admission') }}"
                    class="px-6 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">
                    Enroll Now
                </a>

                <a href="#curriculum"
                    class="px-6 py-3 border border-brand text-brand rounded-md hover:bg-brand hover:text-white transition">
                    View Curriculum
                </a>

            </div>

            <!-- Quick Info -->
            <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-4">

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <h5 class="font-bold text-lg">{{ $course->lessons->count() }}</h5>
                    <p class="text-sm text-slate-500">Lessons</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <h5 class="font-bold text-lg">{{ $course->duration }}</h5>
                    <p class="text-sm text-slate-500">Duration</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <h5 class="font-bold text-lg">{{ ucfirst($course->level) }}</h5>
                    <p class="text-sm text-slate-500">Level</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <h5 class="font-bold text-lg">
                        {{ $course->status == 1 ? 'Active' : 'Draft' }}
                    </h5>
                    <p class="text-sm text-slate-500">Status</p>
                </div>

            </div>
        </div>

        <div class="flex justify-center lg:justify-end">
            <img src="{{ asset($course->thumbnail) }}"
                alt="{{ $course->title }}"
                class="rounded-2xl shadow-2xl w-full max-w-xl object-cover">
        </div>

    </div>
</section>

<!-- Main Content -->
<section class="container mx-auto px-4 lg:px-8 py-16">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        <!-- Left Content -->
        <div class="lg:col-span-2">

            <!-- Overview -->
            <div class="bg-white rounded-2xl shadow p-8">
                <h2 class="text-3xl font-bold mb-6">
                    Course Overview
                </h2>

                <div class="text-slate-600 leading-relaxed space-y-4">
                    {!! nl2br(e($course->description)) !!}
                </div>
            </div>

            <!-- Curriculum -->
            <section id="curriculum" class="mt-12">

                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-3xl font-bold">
                        Course Curriculum
                    </h3>

                    <span class="text-sm bg-brand/10 text-brand px-4 py-2 rounded-full">
                        {{ $course->lessons->count() }} Lessons
                    </span>
                </div>

                <div class="space-y-5">

                    @forelse ($course->lessons->sortBy('order') as $lesson)

                        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                            <div class="p-6">

                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                    <div class="flex items-start gap-4">

                                        <div class="w-12 h-12 rounded-full bg-brand text-white flex items-center justify-center font-bold text-lg">
                                            {{ $loop->iteration }}
                                        </div>

                                        <div>

                                            <div class="flex items-center gap-3 flex-wrap">

                                                <h4 class="text-xl font-semibold">
                                                    {{ $lesson->title }}
                                                </h4>

                                                @if($lesson->is_free)
                                                    <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                                        Free Preview
                                                    </span>
                                                @endif

                                            </div>

                                            @if($lesson->description)
                                                <p class="text-slate-600 mt-2 leading-relaxed">
                                                    {{ $lesson->description }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                    <div class="text-sm text-slate-500 whitespace-nowrap">
                                        {{ $lesson->duration }} Minutes
                                    </div>

                                </div>

                                <!-- @if($lesson->video_url)
                                    <div class="mt-5">
                                        <a href="{{ $lesson->video_url }}"
                                            target="_blank"
                                            class="inline-flex items-center gap-2 text-brand font-medium hover:underline">
                                            ▶ Watch Lesson
                                        </a>
                                    </div>
                                @endif -->

                                @if($lesson->content)
                                    <div class="mt-5 border-t pt-5">
                                        <div class="prose max-w-none text-slate-700">
                                            {!! $lesson->content !!}
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="bg-white rounded-2xl shadow p-10 text-center">
                            <h4 class="text-xl font-semibold">
                                No Lessons Added Yet
                            </h4>

                            <p class="text-slate-500 mt-2">
                                Course curriculum will be updated soon.
                            </p>
                        </div>

                    @endforelse

                </div>

            </section>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Price Card -->
            <div class="bg-white rounded-2xl shadow p-8 sticky top-24">

                <h3 class="text-2xl font-bold mb-4">
                    Course Pricing
                </h3>

                @if($course->discount && $course->discount > 0)

                    <div class="flex items-center gap-3 mb-3">

                        <h4 class="text-4xl font-extrabold text-brand">
                            ৳{{ number_format($course->price - $course->discount) }}
                        </h4>

                        <span class="text-lg text-slate-400 line-through">
                            ৳{{ number_format($course->price) }}
                        </span>

                    </div>

                    <span class="inline-block bg-red-100 text-red-600 text-sm px-3 py-1 rounded-full">
                        Save ৳{{ number_format($course->discount) }}
                    </span>

                @else

                    <h4 class="text-4xl font-extrabold text-brand mb-3">
                        ৳{{ number_format($course->price) }}
                    </h4>

                @endif

                <p class="text-slate-500 mt-4 text-sm leading-relaxed">
                    One-time payment with lifetime access to all lessons and future updates.
                </p>

                <a href="{{ route('admission') }}"
                    class="mt-6 inline-flex items-center justify-center w-full px-6 py-4 bg-brand text-white rounded-xl font-semibold hover:bg-brand/90 transition">
                    Enroll Now
                </a>

                <!-- Details -->
                <div class="mt-8 border-t pt-6">

                    <h5 class="font-semibold mb-4">
                        Course Includes
                    </h5>

                    <ul class="space-y-4 text-sm text-slate-600">

                        <li class="flex items-center justify-between">
                            <span>Total Lessons</span>
                            <strong>{{ $course->lessons->count() }}</strong>
                        </li>

                        <li class="flex items-center justify-between">
                            <span>Course Level</span>
                            <strong>{{ ucfirst($course->level) }}</strong>
                        </li>

                        <li class="flex items-center justify-between">
                            <span>Duration</span>
                            <strong>{{ $course->duration }}</strong>
                        </li>

                        <li class="flex items-center justify-between">
                            <span>Free Lessons</span>
                            <strong>{{ $course->lessons->where('is_free', 1)->count() }}</strong>
                        </li>

                        <li class="flex items-center justify-between">
                            <span>Access</span>
                            <strong>Lifetime</strong>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section class="bg-brand text-white py-20 mt-16">

    <div class="container mx-auto px-4 text-center">

        <h2 class="text-4xl font-extrabold">
            Start Learning Today
        </h2>

        <p class="mt-4 text-white/80 max-w-2xl mx-auto">
            Join this professional course and build real-world skills with practical lessons and guided projects.
        </p>

        <a href="{{ route('admission') }}"
            class="mt-8 inline-flex items-center px-8 py-4 bg-white text-brand rounded-xl font-semibold shadow-lg hover:bg-slate-100 transition">
            Enroll Today
        </a>

    </div>

</section>

@endsection