@extends('templates.layouts.master')
@section('body')

<!-- Hero -->
<section class="text-center py-16 bg-brand/10">
  <h1 class="text-4xl font-bold text-brand">Our Successful Students</h1>
  <p class="mt-3 text-slate-600">
    Meet students who changed their life with our courses
  </p>
</section>

<!-- Success Grid -->
<section class="container mx-auto px-4 py-12">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-xl shadow text-center">
      <img src="https://i.pravatar.cc/150?img=1" class="w-24 h-24 rounded-full mx-auto">
      <h3 class="mt-4 font-semibold">Rifat Hasan</h3>
      <p class="text-brand text-sm">Frontend Developer</p>
      <p class="text-sm text-slate-500">Web Development Course</p>
      <p class="text-sm mt-3">“I got my first remote job after this course!”</p>
      <button class="open-video mt-4 bg-brand text-white px-4 py-2 rounded"
        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        ▶ Watch Video
      </button>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-xl shadow text-center">
      <img src="https://i.pravatar.cc/150?img=2" class="w-24 h-24 rounded-full mx-auto">
      <h3 class="mt-4 font-semibold">Sadia Akter</h3>
      <p class="text-brand text-sm">UI/UX Designer</p>
      <p class="text-sm text-slate-500">UI/UX Course</p>
      <p class="text-sm mt-3">“Now I work with international clients!”</p>
      <button class="open-video mt-4 bg-brand text-white px-4 py-2 rounded"
        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        ▶ Watch Video
      </button>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-6 rounded-xl shadow text-center">
      <img src="https://i.pravatar.cc/150?img=3" class="w-24 h-24 rounded-full mx-auto">
      <h3 class="mt-4 font-semibold">Tanvir Ahmed</h3>
      <p class="text-brand text-sm">Digital Marketer</p>
      <p class="text-sm text-slate-500">Digital Marketing</p>
      <p class="text-sm mt-3">“Freelancing income changed my life.”</p>
      <button class="open-video mt-4 bg-brand text-white px-4 py-2 rounded"
        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        ▶ Watch Video
      </button>
    </div>

  </div>
</section>

<!-- Video Modal -->
<div id="videoModal" class="fixed inset-0 bg-black/70 flex items-center justify-center hidden z-50">
  <div class="relative w-full max-w-3xl aspect-video bg-black rounded">
    <iframe id="videoFrame" class="w-full h-full" src="" allowfullscreen></iframe>
    <button id="closeModal" class="absolute top-2 right-2 text-white text-3xl">&times;</button>
  </div>
</div>

<!-- CTA -->
<section class="bg-brand text-white py-16 text-center">
  <h2 class="text-3xl font-bold">Be our next success story</h2>
  <a href="course.html" class="mt-6 inline-block bg-white text-brand px-6 py-3 rounded">
    Explore Courses
  </a>
</section>
@endsection