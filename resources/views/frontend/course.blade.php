@extends('layouts.master')
@section('content')

<!-- Hero / Page title -->
<section class="bg-gradient-to-r from-brand/5 to-white py-20">
  <div class="container mx-auto px-4 lg:px-8 text-center">
    <h1 class="text-4xl lg:text-5xl font-extrabold">Our Professional Courses</h1>
    <p class="mt-4 text-slate-600 max-w-2xl mx-auto">
      Explore expert-led courses and grow your skills in design, development, and marketing — from beginner to pro level.
    </p>
  </div>
</section>

<!-- Filters -->
<section class="container mx-auto px-4 lg:px-8 py-10">
  <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
    <div class="flex flex-wrap gap-3">
      <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">All</button>
      <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">Graphic Design</button>
      <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">Motion Graphics</button>
      <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">Web Development</button>
      <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">Digital Marketing</button>
      <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">UI/UX Design</button>
    </div>
    <div>
      <select class="px-4 py-2 border border-slate-300 rounded-md">
        <option>All Levels</option>
        <option>Beginner</option>
        <option>Intermediate</option>
        <option>Advanced</option>
      </select>
    </div>
  </div>
</section>

<!-- Courses grid -->
<section class="container mx-auto px-4 lg:px-8 pb-16">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach ($courses as $course)
      <article class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="course" class="w-full h-44 object-cover" />
        <div class="p-4">
          <h3 class="font-semibold text-lg">{{ $course->title }}</h3>
          <p class="text-sm text-slate-500 mt-1">{{ $course->duration }} • {{ $course->format }}</p>
          <div class="mt-4 flex items-center justify-between">
            <div class="text-lg font-bold">${{ $course->price }}</div>
            <a href="{{ route('course.details', $course->slug) }}" class="px-3 py-2 bg-brand text-white rounded-md text-sm">Visit</a>
          </div>
        </div>
      </article>
    @endforeach
  </div>

  <!-- Pagination -->
  <div class="mt-10 flex justify-center gap-3">
    <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">1</button>
    <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">2</button>
    <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">3</button>
    <button class="px-4 py-2 bg-white border border-slate-300 rounded-md hover:bg-brand hover:text-white transition">Next →</button>
  </div>
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
