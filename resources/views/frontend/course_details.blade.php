@extends('layouts.master')
@section('content')

<!-- Course Hero -->
<section class="bg-gradient-to-r from-brand/5 to-white py-20">
  <div class="container mx-auto px-4 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    <div>
      <h1 class="text-4xl lg:text-5xl font-extrabold">Full Stack Web Development</h1>
      <p class="mt-4 text-slate-600 max-w-lg">
        Master full-stack web development with hands-on projects in HTML, CSS, JavaScript, PHP, Python, and more.
        Suitable for beginners to advanced learners.
      </p>
      <div class="mt-6 flex gap-3">
        <a href="#enroll" class="px-6 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Enroll Now</a>
        <a href="#curriculum" class="px-6 py-3 border border-brand text-brand rounded-md hover:bg-brand hover:text-white transition">View Curriculum</a>
      </div>
    </div>
    <div class="flex justify-center lg:justify-end">
      <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80"
           alt="Full Stack Web Development" 
           class="rounded-lg shadow-lg w-full max-w-md object-cover">
    </div>
  </div>
</section>

<!-- Course Overview -->
<section class="container mx-auto px-4 lg:px-8 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
      <h2 class="text-3xl font-bold">Course Overview</h2>
      <p class="text-slate-600">
        This course takes you from zero to a professional full-stack developer. Learn front-end and back-end development
        with real-world projects, including building websites, web apps, and APIs. You'll gain skills in HTML, CSS,
        JavaScript, PHP, Python, MySQL, and more. Our instructors provide personalized mentorship and hands-on guidance.
      </p>

      <!-- Features -->
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=600&q=80" class="w-full h-32 object-cover rounded-md mb-3" alt="Project Work">
          <h4 class="font-semibold">Hands-on Projects</h4>
          <p class="text-slate-600 mt-2">Work on real-world projects to solidify your learning.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <img src="https://images.unsplash.com/photo-1590608897129-79da98d159e4?auto=format&fit=crop&w=600&q=80" class="w-full h-32 object-cover rounded-md mb-3" alt="Mentorship">
          <h4 class="font-semibold">Expert Mentors</h4>
          <p class="text-slate-600 mt-2">Learn from industry professionals with real experience.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <img src="https://images.unsplash.com/photo-1551836022-4c4c79ecde16?auto=format&fit=crop&w=600&q=80" class="w-full h-32 object-cover rounded-md mb-3" alt="Career Support">
          <h4 class="font-semibold">Career Support</h4>
          <p class="text-slate-600 mt-2">CV reviews, portfolio help, and interview guidance.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=600&q=80" class="w-full h-32 object-cover rounded-md mb-3" alt="Flexible Learning">
          <h4 class="font-semibold">Flexible Learning</h4>
          <p class="text-slate-600 mt-2">Access live classes, recorded videos, and self-paced modules.</p>
        </div>
      </div>

      <!-- Curriculum -->
      <section id="curriculum" class="mt-12">
        <h3 class="text-2xl font-bold">Curriculum</h3>
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
      </section>

      <!-- Instructor -->
      <section class="mt-12">
        <h3 class="text-2xl font-bold">Instructor</h3>
        <div class="flex items-center gap-4 mt-4 bg-white p-6 rounded-lg shadow">
          <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=200&q=80"
               alt="Instructor" class="w-24 h-24 rounded-full object-cover">
          <div>
            <h4 class="font-semibold text-lg">Arif Hossain</h4>
            <p class="text-slate-600 text-sm mt-1">
              Full Stack Developer with 8+ years of industry experience.
              Mentoring students and guiding real projects.
            </p>
          </div>
        </div>
      </section>

      <!-- Student Reviews -->
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
        <div class="text-2xl font-bold text-brand">$420</div>
        <p class="text-slate-600 text-sm mt-1">Full course fee</p>
        <a href="#enroll" class="mt-4 inline-block w-full text-center px-4 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Enroll Now</a>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold">Course Details</h4>
        <ul class="mt-2 text-slate-600 text-sm space-y-1">
          <li>Duration: 6 Months</li>
          <li>Mode: Live + Recorded</li>
          <li>Level: Beginner → Advanced</li>
          <li>Projects: 10+ real-world projects</li>
          <li>Mentorship: 1:1 feedback</li>
        </ul>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <h4 class="font-semibold">Apply Now</h4>
        <p class="text-slate-600 text-sm mt-1">Join now to secure your spot in this popular course.</p>
        <a href="#apply" class="mt-3 inline-block w-full text-center px-4 py-3 bg-brand text-white rounded-md shadow hover:bg-brand/90 transition">Apply Now</a>
      </div>
    </div>
  </div>
</section>

@endsection
