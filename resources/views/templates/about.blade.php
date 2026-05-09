@extends('templates.layouts.master')
@section('body')

<!-- HERO -->
 
<section class="bg-gradient-to-r from-red-50 to-white py-16">
  <div class="max-w-6xl mx-auto px-4 grid lg:grid-cols-2 gap-10 items-center">
    
    <div>
      <h1 class="text-4xl lg:text-5xl font-bold">
        About GenZ IT
      </h1>
      <p class="mt-4 text-lg text-slate-600">
        We help students learn high-income digital skills and start earning through freelancing and jobs.
      </p>

      <div class="mt-6 space-y-2 text-sm">
        <p>✔ Practical Learning</p>
        <p>✔ Freelancing Roadmap</p>
        <p>✔ Career Support</p>
      </div>
    </div>

    <div>
      <img src="https://placehold.co/500x400" class="rounded-lg shadow">
    </div>

  </div>
</section>

<!-- MISSION -->
<section class="max-w-6xl mx-auto px-4 py-16">
  <div class="grid lg:grid-cols-2 gap-10">

    <div>
      <h2 class="text-3xl font-bold">Our Mission</h2>
      <p class="mt-4 text-slate-600">
        Our mission is to teach practical skills that help students earn money online or get jobs quickly.
      </p>

      <h2 class="text-3xl font-bold mt-8">Our Vision</h2>
      <p class="mt-4 text-slate-600">
        To become a leading digital skills institute helping thousands of students build successful careers.
      </p>
    </div>

    <div class="space-y-5">
      <div class="bg-white p-5 shadow rounded">
        <h4 class="font-semibold">Hands-on Learning</h4>
        <p class="text-sm text-slate-600 mt-2">Real projects included</p>
      </div>

      <div class="bg-white p-5 shadow rounded">
        <h4 class="font-semibold">Expert Mentors</h4>
        <p class="text-sm text-slate-600 mt-2">Industry professionals</p>
      </div>

      <div class="bg-white p-5 shadow rounded">
        <h4 class="font-semibold">Career Support</h4>
        <p class="text-sm text-slate-600 mt-2">CV + Interview help</p>
      </div>
    </div>

  </div>
</section>

<!-- TEAM -->
<section class="bg-red-50 py-16">
  <div class="max-w-6xl mx-auto px-4 text-center">

    <h3 class="text-3xl font-bold">Meet Our Team</h3>

    <div class="grid md:grid-cols-4 gap-6 mt-10">

      <div class="bg-white p-5 rounded shadow">
        <img src="https://placehold.co/150" class="mx-auto rounded-full">
        <h5 class="mt-3 font-semibold">Rahim Ahmed</h5>
        <p class="text-sm text-slate-600">Web Developer</p>
      </div>

      <div class="bg-white p-5 rounded shadow">
        <img src="https://placehold.co/150" class="mx-auto rounded-full">
        <h5 class="mt-3 font-semibold">Karim Hasan</h5>
        <p class="text-sm text-slate-600">Graphic Designer</p>
      </div>

      <div class="bg-white p-5 rounded shadow">
        <img src="https://placehold.co/150" class="mx-auto rounded-full">
        <h5 class="mt-3 font-semibold">Nusrat Jahan</h5>
        <p class="text-sm text-slate-600">Digital Marketer</p>
      </div>

      <div class="bg-white p-5 rounded shadow">
        <img src="https://placehold.co/150" class="mx-auto rounded-full">
        <h5 class="mt-3 font-semibold">Sabbir Khan</h5>
        <p class="text-sm text-slate-600">Instructor</p>
      </div>

    </div>

  </div>
</section>

<!-- STATS -->
<section class="max-w-6xl mx-auto px-4 py-16 text-center">
  <div class="grid md:grid-cols-3 gap-6">

    <div class="shadow p-6 rounded">
      <h3 class="text-3xl font-bold">5000+</h3>
      <p class="text-sm text-slate-600">Students</p>
    </div>

    <div class="shadow p-6 rounded">
      <h3 class="text-3xl font-bold">10000+</h3>
      <p class="text-sm text-slate-600">Projects</p>
    </div>

    <div class="shadow p-6 rounded">
      <h3 class="text-3xl font-bold">80%</h3>
      <p class="text-sm text-slate-600">Success Rate</p>
    </div>

  </div>
</section>

<!-- TESTIMONIAL -->
<section class="bg-red-50 py-16">
  <div class="max-w-6xl mx-auto px-4 text-center">

    <h3 class="text-3xl font-bold">Student Reviews</h3>

    <div class="grid md:grid-cols-3 gap-6 mt-10">

      <div class="bg-white p-5 rounded shadow">
        <img src="https://placehold.co/300x200" class="rounded">
        <p class="mt-3 text-sm">I started earning within 3 months.</p>
      </div>

      <div class="bg-white p-5 rounded shadow">
        <img src="https://placehold.co/300x200" class="rounded">
        <p class="mt-3 text-sm">Best training center for beginners.</p>
      </div>

      <div class="bg-white p-5 rounded shadow">
        <img src="https://placehold.co/300x200" class="rounded">
        <p class="mt-3 text-sm">Highly recommended for freelancing.</p>
      </div>

    </div>

  </div>
</section>

<!-- CTA -->
<section class="py-16 text-center">
  <h3 class="text-3xl font-bold">Start Your Career Today</h3>
  <p class="mt-4 text-slate-600">Join GenZ IT and build your future</p>

  <button class="mt-6 bg-red-500 text-white px-6 py-3 rounded">
    Apply Now
  </button>
</section>

@endsection