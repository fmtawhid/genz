@extends('templates.layouts.master')
@section('body')


<!-- Hero -->
<section class="bg-gradient-to-r from-brand/5 to-white py-16 text-center">
  <h1 class="text-4xl font-extrabold">Our Professional Courses</h1>
  <p class="mt-3 text-slate-600 max-w-xl mx-auto">
    Explore expert-led courses and grow your skills.
  </p>
</section>


<!-- Courses -->
<section class="container mx-auto px-4 py-16">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    @forelse($courses as $course)
    <!-- Dynamic Course Card -->
    <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
      <img src="{{ $course->thumbnail ? asset($course->thumbnail) : 'https://placehold.co/400x250?text=' . urlencode($course->title) }}" class="w-full h-48 object-cover">
      <div class="p-5">
        <h3 class="font-bold text-xl">{{ $course->title }}</h3>
        <p class="text-sm text-slate-500">{{ $course->duration ?? 'N/A' }} Hours</p>
        <p class="mt-2 text-slate-600 line-clamp-2">{{ $course->description ?? 'Professional course content' }}</p>
        <div class="mt-2 flex items-center gap-2">
          <span class="text-xs font-medium bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $course->lessons->count() }} Lessons</span>
          <span class="text-xs font-medium bg-amber-100 text-amber-800 px-2 py-1 rounded">{{ $course->level ?? 'All Level' }}</span>
        </div>
        <div class="mt-4 flex justify-between items-center">
          <span class="text-xl font-bold">৳{{ number_format($course->price ?? 0) }}</span>
          <a href="{{ route('course.details', $course->slug) }}" class="bg-brand text-white px-3 py-1 rounded text-sm hover:bg-brand/90 transition">Details</a>
        </div>
      </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
      <p class="text-slate-600 text-lg">No courses available yet. Check back soon!</p>
    </div>
    @endforelse

  </div>

  <!-- Pagination -->
  @if($courses->hasPages())
  <div class="mt-12 flex justify-center">
    {{ $courses->links() }}
  </div>
  @endif
</section>


<!-- CTA -->
<section class="text-center py-16 bg-brand/5">
  <h3 class="text-3xl font-bold">Start Learning Today</h3>
  <a href="admission.html" class="mt-4 inline-block bg-brand text-white px-6 py-3 rounded">
    Apply Now
  </a>
</section>

@endsection