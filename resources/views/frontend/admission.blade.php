@extends('layouts.master')

@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-brand/10 to-white py-20 text-center">
  <div class="container mx-auto px-4">
    <h1 class="text-4xl md:text-5xl font-extrabold text-brand">Admission Now Open</h1>
    <p class="text-slate-600 mt-3 max-w-2xl mx-auto">
      Join our career-oriented professional courses and start your journey toward success. 
      Limited seats available — apply today!
    </p>
  </div>
</section>

<!-- Admission Form Section -->
<section class="container mx-auto px-4 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
    
    <!-- Admission Form -->
    <div class="bg-white shadow-lg rounded-xl p-8">
      <h2 class="text-2xl font-bold text-brand mb-6">Admission Form</h2>

      <form action="#" method="POST" class="space-y-5">
        @csrf

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Full Name <span class="text-red-500">*</span></label>
          <input type="text" name="name" required class="w-full border border-slate-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand">
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
          <input type="email" name="email" class="w-full border border-slate-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand">
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
          <input type="text" name="phone" required class="w-full border border-slate-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand">
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Select Course <span class="text-red-500">*</span></label>
          <select name="course" required class="w-full border border-slate-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand">
            <option value="">-- Select a Course --</option>
            <option>Full Stack Web Development</option>
            <option>App Development (Flutter)</option>
            <option>Digital Marketing</option>
            <option>Graphics & UI Design</option>
            <option>Data Science & AI</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Preferred Batch Time</label>
          <select name="batch_time" class="w-full border border-slate-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand">
            <option value="">-- Choose --</option>
            <option>Morning Batch</option>
            <option>Afternoon Batch</option>
            <option>Evening Batch</option>
            <option>Weekend (Fri-Sat)</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Why do you want to join?</label>
          <textarea name="reason" rows="3" class="w-full border border-slate-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand"></textarea>
        </div>

        <button type="submit" class="w-full bg-brand text-white font-semibold py-3 rounded-md hover:bg-brand/90 transition">
          Submit Application
        </button>
      </form>
    </div>

    <!-- Admission Info -->
    <div class="bg-brand/5 rounded-xl p-8 shadow-inner">
      <h3 class="text-2xl font-bold mb-4 text-brand">Why Choose Us?</h3>
      <ul class="space-y-3 text-slate-700">
        <li>✅ Industry-expert instructors with 8+ years of experience</li>
        <li>✅ 1:1 mentorship & real-world projects</li>
        <li>✅ Job placement & career support</li>
        <li>✅ Live + recorded classes for flexibility</li>
        <li>✅ Certificates upon completion</li>
      </ul>

      <div class="mt-8">
        <h4 class="font-semibold text-lg mb-2">Admission Details</h4>
        <p><strong>Admission Fee:</strong> ৳500 (one-time)</p>
        <p><strong>Course Duration:</strong> 4–6 months (varies by course)</p>
        <p><strong>Class Mode:</strong> Live & Recorded</p>
      </div>

      <div class="mt-8 text-center">
        <a href="{{ route('course') }}" class="inline-block bg-brand text-white px-6 py-3 rounded-md shadow hover:bg-brand/90 transition">
          View All Courses
        </a>
      </div>
    </div>

  </div>
</section>

<!-- CTA Section -->
<section class="bg-brand text-white py-16 text-center rounded-t-[3rem]">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold">Ready to start your learning journey?</h2>
    <p class="text-white/80 mt-3 max-w-2xl mx-auto">
      Enroll today and take the first step toward building your dream career.
    </p>
    <a href="{{ route('course') }}" class="mt-6 inline-block bg-white text-brand px-6 py-3 rounded-md font-semibold shadow hover:bg-slate-100 transition">
      Explore Courses
    </a>
  </div>
</section>

@endsection
