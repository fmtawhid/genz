@extends('layouts.master')
@section('content')
  <!-- Hero -->
  <section class="bg-gradient-to-r from-brand/5 to-white">
    <div class="container mx-auto px-4 lg:px-8 py-12 lg:py-20">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <div>
          <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight">Become an IT Pro & Rule the Digital World</h1>
          <p class="mt-4 text-slate-600 max-w-xl">Hands-on courses, real projects, and job support to kickstart your career in design, development, and digital marketing.</p>

          <div class="mt-6 flex flex-wrap gap-3">
            <a href="#courses" class="inline-flex items-center gap-2 bg-brand text-white px-4 py-3 rounded-md shadow-md">Explore Courses</a>
            <a href="#apply" class="inline-flex items-center gap-2 border border-brand text-brand px-4 py-3 rounded-md">Apply Now</a>
          </div>

          <!-- Quick category chips -->
          <div class="mt-8 flex flex-wrap gap-3">
            <span class="px-3 py-2 bg-slate-100 rounded-full text-sm">Graphic Design</span>
            <span class="px-3 py-2 bg-slate-100 rounded-full text-sm">Motion Graphics</span>
            <span class="px-3 py-2 bg-slate-100 rounded-full text-sm">Web Development</span>
            <span class="px-3 py-2 bg-slate-100 rounded-full text-sm">Digital Marketing</span>
          </div>
        </div>

        <div class="flex justify-center lg:justify-end">
          <img src="https://placehold.co/520x360/png?text=Hero+Image" alt="hero" class="rounded-lg shadow-lg w-full max-w-[520px] object-cover" />
        </div>
      </div>
    </div>
  </section>

  <!-- Categories quick menu -->
  <section class="container mx-auto px-4 lg:px-8 py-8">
    <div class="overflow-x-auto">
      <div class="flex gap-4 items-center py-2">
        <a href="#" class="flex-shrink-0 w-40 bg-white rounded-lg p-4 shadow hover:shadow-md transition">
          <div class="text-xl font-semibold">Graphic Design</div>
          <div class="text-sm text-slate-500 mt-1">Courses & Projects</div>
        </a>
        <a href="#" class="flex-shrink-0 w-40 bg-white rounded-lg p-4 shadow hover:shadow-md transition">
          <div class="text-xl font-semibold">Motion Graphics</div>
          <div class="text-sm text-slate-500 mt-1">Animate & FX</div>
        </a>
        <a href="#" class="flex-shrink-0 w-40 bg-white rounded-lg p-4 shadow hover:shadow-md transition">
          <div class="text-xl font-semibold">UI / UX</div>
          <div class="text-sm text-slate-500 mt-1">Design Interfaces</div>
        </a>
        <a href="#" class="flex-shrink-0 w-40 bg-white rounded-lg p-4 shadow hover:shadow-md transition">
          <div class="text-xl font-semibold">Web Dev</div>
          <div class="text-sm text-slate-500 mt-1">Python, JS, PHP</div>
        </a>
        <a href="#" class="flex-shrink-0 w-40 bg-white rounded-lg p-4 shadow hover:shadow-md transition">
          <div class="text-xl font-semibold">Digital Mkt</div>
          <div class="text-sm text-slate-500 mt-1">SEO & Ads</div>
        </a>
      </div>
    </div>
  </section>

  <!-- Instructors banner -->
  <section class="bg-white border-t border-b py-8">
    <div class="container mx-auto px-4 lg:px-8 flex flex-col lg:flex-row items-center gap-6">
      <div class="flex gap-4 items-center">
        <img src="https://placehold.co/84x84?text=Instructor+1" alt="instr" class="rounded-full" />
        <img src="https://placehold.co/84x84?text=Instructor+2" alt="instr" class="rounded-full" />
        <img src="https://placehold.co/84x84?text=Instructor+3" alt="instr" class="rounded-full" />
      </div>
      <div>
        <h3 class="text-lg font-semibold">Expert Instructors — Learn from industry professionals</h3>
        <p class="text-sm text-slate-600">Live classes, recorded sessions, and 1:1 mentoring available.</p>
      </div>
      <div class="ml-auto">
        <a href="#instructors" class="inline-flex items-center gap-2 border border-brand text-brand px-4 py-2 rounded-md">Meet Instructors</a>
      </div>
    </div>
  </section>

  <!-- Popular courses -->
  <section id="courses" class="container mx-auto px-4 lg:px-8 py-12">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-2xl font-bold">Popular Courses</h2>
        <p class="text-sm text-slate-600">Top picks for beginners & career changers</p>
      </div>
      <div class="hidden sm:block">
        <a href="#" class="text-sm text-brand hover:underline">View All Courses →</a>
      </div>
    </div>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($courses as $course)
      <article class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="course" class="w-full h-44 object-cover" />
        <div class="p-4">
          <h3 class="font-semibold text-lg">{{ $course->title }}</h3>
          <p class="text-sm text-slate-500 mt-1">{{ $course->duration }} • {{ $course->format }}</p>
          <div class="mt-4 flex items-center justify-between">
            <div class="text-lg font-bold">${{ $course->price }}</div>
            <a href="#" class="px-3 py-2 bg-brand text-white rounded-md text-sm">Enroll</a>
          </div>
        </div>
      </article>
      @endforeach

      <article class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <img src="https://placehold.co/600x340?text=Course+2" alt="course" class="w-full h-44 object-cover" />
        <div class="p-4">
          <h3 class="font-semibold text-lg">Motion Graphics Bootcamp</h3>
          <p class="text-sm text-slate-500 mt-1">10 weeks • Project based</p>
          <div class="mt-4 flex items-center justify-between">
            <div class="text-lg font-bold">$150</div>
            <a href="#" class="px-3 py-2 bg-brand text-white rounded-md text-sm">Enroll</a>
          </div>
        </div>
      </article>

      <article class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <img src="https://placehold.co/600x340?text=Course+3" alt="course" class="w-full h-44 object-cover" />
        <div class="p-4">
          <h3 class="font-semibold text-lg">Full Stack Web Development</h3>
          <p class="text-sm text-slate-500 mt-1">6 months • Hands-on</p>
          <div class="mt-4 flex items-center justify-between">
            <div class="text-lg font-bold">$420</div>
            <a href="#" class="px-3 py-2 bg-brand text-white rounded-md text-sm">Enroll</a>
          </div>
        </div>
      </article>
    </div>
  </section>

  <!-- Stats -->
  <section class="bg-gradient-to-r from-brand/5 to-white py-8">
    <div class="container mx-auto px-4 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
        <div class="bg-white rounded-lg p-6 shadow">
          <div class="text-3xl font-bold">20000+</div>
          <div class="text-sm text-slate-600">Students Trained</div>
        </div>
        <div class="bg-white rounded-lg p-6 shadow">
          <div class="text-3xl font-bold">42000+</div>
          <div class="text-sm text-slate-600">Projects Completed</div>
        </div>
        <div class="bg-white rounded-lg p-6 shadow">
          <div class="text-3xl font-bold">89%</div>
          <div class="text-sm text-slate-600">Placement Rate</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Success Stories -->
  <section class="container mx-auto px-4 lg:px-8 py-12">
    <h3 class="text-2xl font-bold">Success Stories</h3>
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <figure class="bg-white p-4 rounded-lg shadow">
        <img src="https://placehold.co/400x260?text=Student+1" alt="student" class="w-full h-40 object-cover rounded" />
        <figcaption class="mt-3">
          <div class="font-semibold">Rahat — UI Designer</div>
          <p class="text-sm text-slate-600">"Got my first job within 2 months of finishing the course."</p>
        </figcaption>
      </figure>

      <figure class="bg-white p-4 rounded-lg shadow">
        <img src="https://placehold.co/400x260?text=Student+2" alt="student" class="w-full h-40 object-cover rounded" />
        <figcaption class="mt-3">
          <div class="font-semibold">Mina — Motion Artist</div>
          <p class="text-sm text-slate-600">"Portfolio-ready projects and mentor feedback helped a lot."</p>
        </figcaption>
      </figure>

      <figure class="bg-white p-4 rounded-lg shadow">
        <img src="https://placehold.co/400x260?text=Student+3" alt="student" class="w-full h-40 object-cover rounded" />
        <figcaption class="mt-3">
          <div class="font-semibold">Arif — Frontend Dev</div>
          <p class="text-sm text-slate-600">"Hands-on classes made concepts very clear."</p>
        </figcaption>
      </figure>
    </div>
  </section>


  <!-- Features -->
  <section class="container mx-auto px-4 lg:px-8 py-12">
    <h3 class="text-2xl font-bold">Exclusive Solutions that Set Us Apart</h3>
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold">Industry Experts</h4>
        <p class="text-sm text-slate-600 mt-2">Practitioner-led sessions and real-world projects.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold">Online + Offline</h4>
        <p class="text-sm text-slate-600 mt-2">Flexible learning modes to suit your needs.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold">Career Support</h4>
        <p class="text-sm text-slate-600 mt-2">Portfolio reviews, interview prep, and placement help.</p>
      </div>
    </div>
  </section>

  <!-- Courses by category -->
  <section class="bg-brand/5 py-10">
    <div class="container mx-auto px-4 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg p-4 shadow">
          <h5 class="font-semibold">Graphic & Motion</h5>
          <ul class="mt-3 text-sm text-slate-600 space-y-2">
            <li>Graphic Design</li>
            <li>Motion Graphics</li>
            <li>3D Animation</li>
          </ul>
        </div>
        <div class="bg-white rounded-lg p-4 shadow">
          <h5 class="font-semibold">Web & Software</h5>
          <ul class="mt-3 text-sm text-slate-600 space-y-2">
            <li>Full Stack</li>
            <li>Python & Django</li>
            <li>React & Next.js</li>
          </ul>
        </div>
        <div class="bg-white rounded-lg p-4 shadow">
          <h5 class="font-semibold">Digital Marketing</h5>
          <ul class="mt-3 text-sm text-slate-600 space-y-2">
            <li>SEO</li>
            <li>Facebook & Google Ads</li>
            <li>Content Strategy</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Seminar -->
  <section id="seminar" class="container mx-auto px-4 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
      <div>
        <h4 class="text-xl font-bold">Join Our Free Seminars</h4>
        <p class="mt-2 text-slate-600">Weekly seminars that introduce you to career paths and practical skills.</p>
        <a href="#" class="mt-4 inline-block px-4 py-2 bg-brand text-white rounded-md">Register</a>
      </div>
      <div>
        <img src="https://placehold.co/640x380?text=Seminar" alt="seminar" class="rounded-lg shadow" />
      </div>
    </div>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white rounded-lg p-6 shadow flex gap-4">
        <img src="https://placehold.co/120x120?text=Class" alt="class" class="rounded" />
        <div>
          <h5 class="font-semibold">Project-based Classes</h5>
          <p class="text-sm text-slate-600 mt-1">Small batches, real projects, instructor feedback.</p>
        </div>
      </div>
      <div class="bg-white rounded-lg p-6 shadow flex gap-4">
        <img src="https://placehold.co/120x120?text=Job" alt="job" class="rounded" />
        <div>
          <h5 class="font-semibold">Career Services</h5>
          <p class="text-sm text-slate-600 mt-1">CV help, portfolio reviews, and employer connects.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Partners -->
  <section id="partners" class="bg-white py-12 border-t">
    <div class="container mx-auto px-4 lg:px-8">
      <h4 class="text-xl font-bold">3000+ Companies Are Connected to Us</h4>
      <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-6 items-center">
        <img src="https://placehold.co/120x60?text=Logo+1" alt="logo" class="object-contain" />
        <img src="https://placehold.co/120x60?text=Logo+2" alt="logo" class="object-contain" />
        <img src="https://placehold.co/120x60?text=Logo+3" alt="logo" class="object-contain" />
        <img src="https://placehold.co/120x60?text=Logo+4" alt="logo" class="object-contain" />
        <img src="https://placehold.co/120x60?text=Logo+5" alt="logo" class="object-contain" />
        <img src="https://placehold.co/120x60?text=Logo+6" alt="logo" class="object-contain" />
      </div>
    </div>
  </section>
@endsection
