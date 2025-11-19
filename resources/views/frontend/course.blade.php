@extends('layouts.master')
@section('content')

<!-- Hero / Page title + Search -->
<section class="bg-gradient-to-r from-brand/5 to-white py-16">
  <div class="container mx-auto px-4 lg:px-8">
    <div class="text-center">
      <h1 class="text-4xl lg:text-5xl font-extrabold">Our Professional Courses</h1>
      <p class="mt-4 text-slate-600 max-w-2xl mx-auto">
        Explore expert-led courses and grow your skills in design, development, and marketing — from beginner to pro level.
      </p>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('course') }}" class="mt-8 max-w-2xl mx-auto">
      <div class="flex gap-3">
        <input
          type="text"
          name="q"
          value="{{ request('q') }}"
          placeholder="Search courses by title or description…"
          class="flex-1 px-4 py-3 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand/50"
        />
        <button class="px-5 py-3 bg-brand text-white rounded-md hover:bg-brand/90 transition">
          Search
        </button>
        @if(request('q'))
          <a href="{{ route('course') }}" class="px-5 py-3 bg-white border border-slate-300 rounded-md hover:bg-slate-50">
            Clear
          </a>
        @endif
      </div>
      @if(request('q'))
        <p class="text-sm text-slate-500 mt-2">
          Showing results for: <span class="font-medium">“{{ request('q') }}”</span>
        </p>
      @endif
    </form>
  </div>
</section>

<!-- Courses grid -->
<section class="container mx-auto px-4 lg:px-8 pb-16">
  @if($courses->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

      @foreach ($courses as $course)
        @php
          $imgPath = $course->image ? public_path('uploads/courses/'.$course->image) : null;
          $imageUrl = ($imgPath && file_exists($imgPath))
              ? asset('uploads/courses/'.$course->image)
              : 'https://via.placeholder.com/800x400.png?text=Course';
          $priceText = isset($course->price) ? '৳'.number_format((float)$course->price, 2) : 'Free';
          $reviewsCount = $course->reviews_count ?? 0;
          $studentsCount = $course->students_count ?? 0;
        @endphp

        <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 border border-slate-100 overflow-hidden group">
          
          <div class="relative">
            <img src="{{ $imageUrl }}" alt="{{ $course->title }}" 
                 class="w-full h-48 object-cover rounded-t-xl group-hover:scale-105 transition duration-300" />
            
            <span class="absolute top-4 left-4 text-sm font-medium text-amber-600 bg-white/70 px-2 py-1 rounded">
              All Course
            </span>
          </div>

          <div class="p-5">
            <h3 class="font-semibold text-xl text-slate-800 mb-2 line-clamp-1">{{ $course->title }}</h3>

            <p class="text-sm text-slate-500">
              {{ $course->duration ?? 'N/A' }} Months
            </p>

            <p class="text-sm text-slate-600 mt-2 line-clamp-2">{{ $course->short_description }}</p>

            <!-- Rating + Students -->
            <div class="mt-4 flex items-center justify-between text-sm text-slate-600">
              <div class="flex items-center gap-2">
                <div class="flex text-amber-400">
                  @for($i=1; $i<=5; $i++)
                    <svg class="w-5 h-5 fill-current {{ $i <= round($course->average_rating ?? 0) ? '' : 'text-gray-300' }}" viewBox="0 0 24 24">
                      <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                  @endfor
                </div>
                <span>{{ number_format($reviewsCount) }} Reviews</span>
              </div>

              <span>{{ number_format($studentsCount) }} Students</span>
            </div>

            <!-- Price + Visit -->
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
              <p class="text-xl font-bold text-slate-800">Course Fee {{ $priceText }}</p>
              <a href="{{ route('course.details', $course->slug) }}" 
                 class="px-4 py-2 bg-white text-orange-600 border border-orange-400 rounded-md text-sm font-medium hover:bg-orange-50 transition duration-150">
                 Visit Now
              </a>
            </div>
          </div>
        </article>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-10">
      {{ $courses->onEachSide(1)->links() }}
    </div>

  @else
    <div class="bg-white border border-slate-200 rounded-lg p-8 text-center">
      <h3 class="text-xl font-semibold">No courses found</h3>
      <p class="text-slate-600 mt-2">Try a different search term or clear the filter.</p>
      <a href="{{ route('course') }}" class="mt-4 inline-block px-5 py-3 bg-brand text-white rounded-md">
        View all courses
      </a>
    </div>
  @endif
</section>

<!-- CTA -->
<section class="bg-brand/5 py-16 text-center">
  <h3 class="text-3xl font-bold">Start Learning Today</h3>
  <p class="mt-4 text-slate-600 max-w-lg mx-auto">
    Join our growing community of learners and gain industry-ready skills with mentorship and real-world projects.
  </p>
  <a href="#apply" class="mt-6 inline-block px-6 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Apply Now</a>
</section>

@endsection
