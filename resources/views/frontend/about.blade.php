@extends('layouts.master')
@section('content')

<!-- Hero Banner -->
<section class="bg-gradient-to-r from-brand/5 to-white py-20">
  <div class="container mx-auto px-4 lg:px-8 flex flex-col lg:flex-row items-center gap-12">
    <div class="lg:w-1/2">
      <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">About Creative IT</h1>
      <p class="mt-4 text-slate-600 max-w-lg">We empower students and professionals with practical skills in design, development, and digital marketing. Learn with hands-on projects and industry guidance.</p>
      <a href="#mission" class="mt-6 inline-block px-6 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Learn More</a>
    </div>
    <div class="lg:w-1/2 flex justify-center">
      <img src="{{ asset("assets/img/home2.jpeg") }}" alt="About Creative IT" class="rounded-lg shadow-lg w-full max-w-md object-cover">
    </div>
  </div>
</section>

<!-- Mission & Vision -->
<section id="mission" class="container mx-auto px-4 lg:px-8 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
    <div class="flex flex-col justify-center gap-6">
      <h2 class="text-3xl font-bold">Our Mission</h2>
      <p class="text-slate-600">To provide high-quality, practical education that bridges the gap between learning and real-world industry demands. We focus on skill-building, project experience, and career readiness.</p>
      <h2 class="text-3xl font-bold mt-8">Our Vision</h2>
      <p class="text-slate-600">To be the leading institute empowering learners globally, creating a skilled workforce ready for the digital era.</p>
    </div>
    <div class="grid grid-cols-1 gap-6">
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="font-semibold text-xl">Hands-on Learning</h4>
        <p class="text-slate-600 mt-2">Practical courses and real projects to master skills quickly.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="font-semibold text-xl">Expert Instructors</h4>
        <p class="text-slate-600 mt-2">Learn from industry professionals and get mentorship.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="font-semibold text-xl">Career Support</h4>
        <p class="text-slate-600 mt-2">Portfolio reviews, job connections, and placement assistance.</p>
      </div>
    </div>
  </div>
</section>

<!-- Team / Instructors -->
<section class="bg-brand/5 py-16">
  <div class="container mx-auto px-4 lg:px-8 text-center">
    <h3 class="text-3xl font-bold">Meet Our Expert Team</h3>
    <p class="mt-2 text-slate-600">Industry professionals who guide and mentor you.</p>
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
    
      @foreach ($teacher as $t)
      <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <img src="{{ asset('img/teachers/'.$t->image) }}" alt="{{ $t->name }}" class="w-32 h-32 mx-auto rounded-full object-cover">
        <h5 class="mt-4 font-semibold">{{ $t->name }}</h5>
        <p class="text-slate-600 text-sm mt-1">{{ $t->designation }}</p>
      </div>
      @endforeach
      
    </div>
  </div>
</section>

<!-- Stats -->
<section class="container mx-auto px-4 lg:px-8 py-16">
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
    <div class="bg-white rounded-lg p-6 shadow">
      <div class="text-3xl font-bold">20000+</div>
      <div class="text-slate-600 text-sm mt-1">Students Trained</div>
    </div>
    <div class="bg-white rounded-lg p-6 shadow">
      <div class="text-3xl font-bold">42000+</div>
      <div class="text-slate-600 text-sm mt-1">Projects Completed</div>
    </div>
    <div class="bg-white rounded-lg p-6 shadow">
      <div class="text-3xl font-bold">89%</div>
      <div class="text-slate-600 text-sm mt-1">Placement Rate</div>
    </div>
  </div>
</section>

<!-- Testimonials -->
<section class="bg-brand/5 py-16">
  <div class="container mx-auto px-4 lg:px-8 text-center">
    <h3 class="text-3xl font-bold">What Our Students Say</h3>
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($student_review as $sr)
      <figure class="bg-white p-6 rounded-lg shadow">
        <img src="{{ asset('img/reviews/'.$sr->image) }}" alt="{{ $sr->name }}" class="w-full h-40 object-cover rounded">
        <figcaption class="mt-4">
          <div class="font-semibold">{{ $sr->name }} — {{ $sr->course->title }}</div>
        </figcaption>
      </figure>
      @endforeach
      
    </div>
  </div>
</section>

<!-- CTA / Apply Now -->
<section class="bg-white py-16 text-center">
  <h3 class="text-3xl font-bold">Start Your Career with GenZ IT Today</h3>
  <p class="mt-4 text-slate-600 max-w-lg mx-auto">Enroll in our courses and gain the skills to succeed in the digital world.</p>
  <a href="{{ route('admission') }}" class="mt-6 inline-block px-6 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Apply Now</a>
</section>

@endsection
