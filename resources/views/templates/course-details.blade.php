@extends('templates.layouts.master')
@section('body')
<!-- Course Hero -->
<section class="bg-gradient-to-r from-brand/5 to-white py-20">
  <div class="container mx-auto px-4 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    <div>
      <h1 class="text-4xl lg:text-5xl font-extrabold">Web Development - HTML, CSS & JS</h1>
      <p class="mt-4 text-slate-600 max-w-lg">Master modern web development with hands-on projects, industry mentors, and job placement support. Learn HTML5, CSS3, JavaScript, and build real-world websites.</p>
      <div class="mt-6 flex gap-3">
        <a href="admissin.html" class="px-6 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Enroll Now</a>
        <a href="#curriculum" class="px-6 py-3 border border-brand text-brand rounded-md hover:bg-brand hover:text-white transition">View Curriculum</a>
      </div>
    </div>
    <div class="flex justify-center lg:justify-end">
      <img src="https://placehold.co/500x400" alt="Web Development" class="rounded-lg shadow-lg w-full max-w-md object-cover">
    </div>
  </div>
</section>

<!-- Course Overview -->
<section class="container mx-auto px-4 lg:px-8 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
      <h2 class="text-3xl font-bold">Course Overview</h2>
      <p class="text-slate-600">This comprehensive web development course teaches you everything you need to become a professional web developer. From basic HTML markup to advanced JavaScript interactions, you'll build real-world projects alongside experienced instructors who have industry experience.</p>
      
      <!-- Features -->
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="font-semibold">Hands-on Projects</h4>
          <p class="text-slate-600 mt-2">Work on 10+ real-world projects to solidify your learning.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="font-semibold">Live Classes</h4>
          <p class="text-slate-600 mt-2">Interactive sessions with experienced web developers.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="font-semibold">Job Support</h4>
          <p class="text-slate-600 mt-2">CV review, interview prep, and placement assistance.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="font-semibold">Lifetime Access</h4>
          <p class="text-slate-600 mt-2">Access all course materials forever with lifetime updates.</p>
        </div>
      </div>

      <!-- Curriculum -->
      <section id="curriculum" class="mt-12">
        <h3 class="text-2xl font-bold">Curriculum</h3>
        <ul class="mt-4 space-y-4">
          <li class="border-l-4 border-brand pl-4">
            <strong>Module 1:</strong> HTML5 Fundamentals (2 weeks)
            <p class="text-sm text-slate-600 mt-1">Learn semantic HTML, forms, accessibility, and best practices.</p>
          </li>
          <li class="border-l-4 border-brand pl-4">
            <strong>Module 2:</strong> CSS3 & Responsive Design (3 weeks)
            <p class="text-sm text-slate-600 mt-1">Master CSS Grid, Flexbox, animations, and mobile-first design.</p>
          </li>
          <li class="border-l-4 border-brand pl-4">
            <strong>Module 3:</strong> JavaScript Essentials (4 weeks)
            <p class="text-sm text-slate-600 mt-1">Variables, functions, DOM manipulation, and ES6+ features.</p>
          </li>
          <li class="border-l-4 border-brand pl-4">
            <strong>Module 4:</strong> Real-World Projects (3 weeks)
            <p class="text-sm text-slate-600 mt-1">Build portfolio projects and deploy them online.</p>
          </li>
        </ul>
      </section>

      <!-- Instructor -->
      <section class="mt-12">
        <h3 class="text-2xl font-bold">Instructor</h3>
        <div class="mt-4 flex items-center gap-4 bg-white p-6 rounded-lg shadow">
          <img src="https://placehold.co/100x100" alt="Instructor" class="w-20 h-20 rounded-full object-cover">
          <div>
            <h5 class="font-semibold text-lg">Md. Karim Hassan</h5>
            <p class="text-slate-600">Senior Web Developer at TechCorp | 10+ Years Experience</p>
            <p class="text-sm text-slate-600 mt-2">Specialized in modern web development with React, Node.js, and Full-Stack solutions. Has trained 500+ students.</p>
          </div>
        </div>
      </section>

      <!-- Reviews -->
      <section class="mt-12">
        <h3 class="text-2xl font-bold">Student Reviews</h3>
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex text-amber-400">★★★★★</div>
            <p class="text-sm mt-2">"Best web development course! The instructor explained everything clearly and the projects were amazing."</p>
            <p class="font-semibold text-sm mt-3">- Ahmed Hassan</p>
          </div>
          <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex text-amber-400">★★★★★</div>
            <p class="text-sm mt-2">"Got my first job 2 months after completing this course. Highly recommended!"</p>
            <p class="font-semibold text-sm mt-3">- Fariha Khan</p>
          </div>
        </div>
      </section>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold">Course Details</h4>
        <ul class="mt-3 text-slate-600 text-sm space-y-2">
          <li><strong>Duration:</strong> 12 Weeks</li>
          <li><strong>Level:</strong> Beginner to Intermediate</li>
          <li><strong>Classes:</strong> 3x/week (Live + Recorded)</li>
          <li><strong>Students:</strong> 720 Enrolled</li>
          <li><strong>Rating:</strong> ★★★★★ (389 Reviews)</li>
        </ul>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold text-xl">৳18,500</h4>
        <p class="text-slate-600 text-sm mt-1">One-time payment. Access forever with lifetime updates.</p>
        <a href="admissin.html" class="mt-4 inline-block w-full text-center px-4 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Enroll Now</a>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="bg-brand text-white py-16 text-center">
  <h2 class="text-3xl font-bold">Ready to Become a Web Developer?</h2>
  <p class="mt-3 text-white/80">Join 720+ students who have transformed their careers with our program.</p>
  <a href="admissin.html" class="mt-6 inline-block bg-white text-brand px-6 py-3 rounded-md font-semibold shadow hover:bg-slate-100 transition">Enroll Today</a>
</section>
@endsection