@extends('layouts.master')

@section('content')

@php
// Dynamic image (fallback if missing)
$imageUrl = $course->image && file_exists(public_path('uploads/courses/'.$course->image))
? asset('uploads/courses/'.$course->image)
: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80';

// Price format
$priceText = isset($course->price) ? '৳' . number_format((float)$course->price, 2) : 'Free';

// Duration text (already stored as string)
$durationText = $course->duration ?: 'N/A';

// Short/Long descriptions (safe output with line breaks)
$shortDesc = $course->short_description ?: 'No short description available.';
$longDesc = $course->long_description ?: 'No detailed description available.';
@endphp

<!-- Course Hero -->
<section class="bg-gradient-to-r from-brand/5 to-white py-20">
  <div class="container mx-auto px-4 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    <div>
      <h1 class="text-4xl lg:text-5xl font-extrabold">
        {{ $course->title }}
      </h1>
      <p class="mt-4 text-slate-600 max-w-lg">
        {{ $shortDesc }}
      </p>
      <div class="mt-6 flex gap-3">
        {{-- If you have a real enroll route, swap href below --}}
        <a href="#enroll" class="px-6 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Enroll Now</a>
        <a href="#curriculum" class="px-6 py-3 border border-brand text-brand rounded-md hover:bg-brand hover:text-white transition">View Curriculum</a>
      </div>
    </div>
    <div class="flex justify-center lg:justify-end">
      <img src="{{ $imageUrl }}"
        alt="{{ $course->title }}"
        class="rounded-lg shadow-lg w-full max-w-md object-cover">
    </div>
  </div>
</section>

<!-- Course Overview -->
<section class="container mx-auto px-4 lg:px-8 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
      <h2 class="text-3xl font-bold">Course Overview</h2>
      <div class="text-slate-600 prose max-w-none">
        {!! nl2br(e($longDesc)) !!}
      </div>

      <!-- Features (kept as-is / static) -->
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="font-semibold">Hands-on Projects</h4>
          <p class="text-slate-600 mt-2">Work on real-world projects to solidify your learning.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="font-semibold">Expert Mentors</h4>
          <p class="text-slate-600 mt-2">Learn from industry professionals with real experience.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="font-semibold">Career Support</h4>
          <p class="text-slate-600 mt-2">CV reviews, portfolio help, and interview guidance.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="font-semibold">Flexible Learning</h4>
          <p class="text-slate-600 mt-2">Access live classes, recorded videos, and self-paced modules.</p>
        </div>
      </div>

      <!-- Curriculum -->
      <section id="curriculum" class="mt-12">
        <h3 class="text-2xl font-bold">Curriculum</h3>

        {{-- If you want to show dynamic topics, use this block. Otherwise, the static list below stays. --}}
        @if($course->relationLoaded('topics') ? $course->topics->isNotEmpty() : $course->topics()->exists())
        <ul class="mt-4 space-y-4">
          @foreach(($course->topics ?? collect()) as $topic)
          <li class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
            <h5 class="font-semibold">{{ $loop->iteration }}. {{ $topic->name }}</h5>
            @if(!empty($topic->note))
            <p class="text-slate-600 text-sm mt-1">{{ $topic->note }}</p>
            @endif
          </li>
          @endforeach
        </ul>
        @else
        {{-- Fallback: keep previous static curriculum as-is --}}
        <ul class="mt-4 space-y-4">
          <li class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
            <h5 class="font-semibold">Module 1: HTML & CSS</h5>
            <p class="text-slate-600 text-sm mt-1">Introduction, structure, styling, responsive design.</p>
          </li>
          <li class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
            <h5 class="font-semibold">Module 2: JavaScript & DOM</h5>
            <p class="text-slate-600 text-sm mt-1">Dynamic UI, event handling, DOM manipulation.</p>
          </li>
          <li class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
            <h5 class="font-semibold">Module 3: Backend Development</h5>
            <p class="text-slate-600 text-sm mt-1">PHP, Python, database integration, REST APIs.</p>
          </li>
          <li class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
            <h5 class="font-semibold">Module 4: Full Project</h5>
            <p class="text-slate-600 text-sm mt-1">Build a complete web application from scratch.</p>
          </li>
        </ul>
        @endif
      </section>

      <!-- Instructor -->
      <section class="mt-12">
        <h3 class="text-2xl font-bold">Instructor</h3>

        @if($course->relationLoaded('teachers') ? $course->teachers->isNotEmpty() : $course->teachers()->exists())
        <div class="mt-4 space-y-4">
          @foreach(($course->teachers ?? collect()) as $teacher)
          @php
          $teacherImage = ($teacher->image && file_exists(public_path('img/teachers/'.$teacher->image)))
          ? asset('img/teachers/'.$teacher->image)
          : 'https://via.placeholder.com/150x150.png?text=Instructor';
          @endphp
          <div class="flex items-center gap-4 bg-white p-6 rounded-lg shadow">
            <img src="{{ $teacherImage }}" alt="{{ $teacher->name }}" class="w-24 h-24 rounded-full object-cover">

            <div>
              <h4 class="font-semibold text-lg">{{ $teacher->name }}</h4>
              @if(!empty($teacher->designation))
              <p class="text-brand text-sm font-medium">{{ $teacher->designation }}</p>
              @endif
              @if(!empty($teacher->qualification))
              <p class="text-slate-600 text-sm mt-1">{{ $teacher->qualification }}</p>
              @elseif(!empty($teacher->bio))
              <p class="text-slate-600 text-sm mt-1">{{ $teacher->bio }}</p>
              @else
              <p class="text-slate-600 text-sm mt-1">Instructor</p>
              @endif
            </div>
          </div>
          @endforeach
        </div>
        @else
        {{-- fallback if no teacher found --}}
        <div class="flex items-center gap-4 mt-4 bg-white p-6 rounded-lg shadow">
          <img src="https://via.placeholder.com/150x150.png?text=Instructor"
            alt="Instructor" class="w-24 h-24 rounded-full object-cover">
          <div>
            <h4 class="font-semibold text-lg">Instructor</h4>
            <p class="text-slate-600 text-sm mt-1">Details coming soon.</p>
          </div>
        </div>
        @endif
      </section>

      <!-- Student Reviews (kept as-is / static demo) -->
      <section class="mt-12">
        <h3 class="text-2xl font-bold">Student Reviews</h3>
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
          <figure class="bg-white p-6 rounded-lg shadow">
            <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=100&q=80" class="w-12 h-12 rounded-full object-cover mb-3" alt="Rifat">
            <div class="font-semibold">Rifat — Web Developer</div>
            <p class="text-slate-600 text-sm mt-1">
              "This course gave me hands-on experience and confidence to apply for real jobs."
            </p>
          </figure>
          <figure class="bg-white p-6 rounded-lg shadow">
            <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=100&q=80" class="w-12 h-12 rounded-full object-cover mb-3" alt="Sadia">
            <div class="font-semibold">Sadia — Frontend Developer</div>
            <p class="text-slate-600 text-sm mt-1">
              "Clear explanations, projects, and mentor feedback made learning easy."
            </p>
          </figure>
        </div>
      </section>
    </div>

    <!-- Sidebar: Pricing & Enrollment -->
    <div class="space-y-6">

      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold">Course Details</h4>
        <ul class="mt-2 text-slate-600 text-sm space-y-1">
          <li><span class="font-medium">Duration:</span> {{ $durationText }}</li>
          {{-- The following remain as-is; update when you store these fields --}}
          <li><span class="font-medium">Mode:</span> Live + Recorded</li>
          <li><span class="font-medium">Level:</span> Beginner → Advanced</li>
          {{-- Quick dynamic counts for context --}}
          <li><span class="font-medium">Topics:</span> {{ ($course->topics ?? collect())->count() }}</li>
          <li><span class="font-medium">Instructors:</span> {{ ($course->teachers ?? collect())->count() }}</li>
        </ul>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold">Apply Now</h4>
        <div class="text-2xl font-bold text-brand"> {{ $priceText }}</div>
        <p class="text-slate-600 text-sm mt-1">Join now to secure your spot in this popular course.</p>
        <a href="#apply" class="mt-3 inline-block w-full text-center px-4 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Apply Now</a>
      </div>
    </div>
  </div>
</section>

@endsection