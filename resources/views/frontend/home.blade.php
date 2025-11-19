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
          <img src="{{ asset('assets/img/home1.jpeg') }}" alt="hero" class="rounded-lg shadow-lg w-full max-w-[520px] object-cover" />
        </div>
      </div>
    </div>
  </section>

  <!-- Categories quick menu -->
  <!-- <section class="container mx-auto px-4 lg:px-8 py-8">
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
  </section> -->

  <!-- Instructors banner -->
  <!-- <section class="bg-white border-t border-b py-8">
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
  </section> -->

  <!-- Popular Courses -->
  <section id="courses" class="container mx-auto px-4 lg:px-8 py-14">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-3xl font-bold text-slate-800">🔥 Popular Courses</h2>
        <p class="text-slate-500 text-sm mt-1">Top picks crafted for learners & career builders</p>
      </div>
      <div class="hidden sm:block">
        <a href="#" class="text-sm font-medium text-brand hover:underline">View All Courses →</a>
      </div>
    </div>

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      
    @foreach($courses as $course)
    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-slate-100 overflow-hidden">

        <div class="relative">
            <img src="{{ asset('uploads/courses/' . $course->image) }}" 
                alt="{{ $course->title }} Banner"
                class="w-full h-48 object-cover group-hover:scale-105 transition duration-300 rounded-t-xl" />

            <span class="absolute top-4 left-4 text-sm font-medium text-amber-600">
                All Course </span>
        </div>

        <div class="p-5">
            <h3 class="font-semibold text-xl text-slate-800 mb-2">
                {{ $course->title }}
            </h3>
            
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-2">
                    <div class="flex text-amber-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                    <span class="text-slate-600">
                        {{ number_format($course->reviews_count) }} Reviews 
                        </span>
                </div>
                
                <span class="text-slate-600 font-medium">
                    {{ number_format($course->students_count) }} Student 
                    </span>
            </div>

            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                <p class="text-xl font-bold text-slate-800">
                    Course Fee {{ number_format($course->price) }} BDT
                </p>
                
                <a href="{{ route('course.details', $course->slug) }}" 
                  class="px-4 py-2 bg-white text-orange-600 border border-orange-400 rounded-md text-sm font-medium hover:bg-orange-50 transition duration-150">
                    Visit Now
                </a>
            </div>
        </div>
    </article>
    @endforeach



    </div>
  </section>

      <!-- Why Choose Us -->
    <section class="container mx-auto px-4 lg:px-8 py-16">
      <h2 class="text-3xl font-bold text-center">Why Choose Us</h2>
      <p class="text-center text-slate-600 mt-2">We help students grow with practical learning & career support</p>

      <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- Card 1 -->
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-xl transition group border border-slate-100">
          <div class="w-14 h-14 bg-brand/10 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/>
            </svg>
          </div>
          <h4 class="text-lg font-semibold mt-4">Project-Based Learning</h4>
          <p class="text-slate-600 text-sm mt-2">Hands-on training with real-world projects & instructor guidance.</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-xl transition group border border-slate-100">
          <div class="w-14 h-14 bg-brand/10 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
          </div>
          <h4 class="text-lg font-semibold mt-4">Expert Instructors</h4>
          <p class="text-slate-600 text-sm mt-2">Learn from highly experienced and industry-certified trainers.</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-xl transition group border border-slate-100">
          <div class="w-14 h-14 bg-brand/10 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
          </div>
          <h4 class="text-lg font-semibold mt-4">Modern Curriculum</h4>
          <p class="text-slate-600 text-sm mt-2">Updated course materials designed for today’s job market.</p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-xl transition group border border-slate-100">
          <div class="w-14 h-14 bg-brand/10 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
            </svg>
          </div>
          <h4 class="text-lg font-semibold mt-4">Small Batches</h4>
          <p class="text-slate-600 text-sm mt-2">Focused sessions ensuring personal attention for every student.</p>
        </div>

        <!-- Card 5 -->
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-xl transition group border border-slate-100">
          <div class="w-14 h-14 bg-brand/10 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-brand" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path d="M12 14l9-5-9-5-9 5 9 5z"/>
              <path d="M12 14l6.16-3.422a12 12 0 01-12.32 0L12 14z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"/>
            </svg>
          </div>
          <h4 class="text-lg font-semibold mt-4">Job Placement Support</h4>
          <p class="text-slate-600 text-sm mt-2">CV review, portfolio building & interview preparation.</p>
        </div>

        <!-- Card 6 -->
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-xl transition group border border-slate-100">
          <div class="w-14 h-14 bg-brand/10 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4l8 8-8 8"/>
            </svg>
          </div>
          <h4 class="text-lg font-semibold mt-4">Flexible Class Schedule</h4>
          <p class="text-slate-600 text-sm mt-2">Weekend & evening batches suitable for busy learners.</p>
        </div>

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

      @foreach($reviews as $review)
        <figure class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
          
          <!-- Image -->
          <img 
            src="{{ $review->image ? asset('img/reviews/' . $review->image) : 'https://placehold.co/400x260?text=No+Image' }}" 
            alt="student" 
            class="w-full h-40 object-cover rounded"
          />

          <figcaption class="mt-3">

            <!-- Name + Position -->
            <div class="font-semibold">
              {{ $review->student_name }} 
              @if($review->position_name)
                — {{ $review->position_name }}
              @endif
            </div>

            <!-- Review Text -->
            <p class="text-sm text-slate-600 mt-1">
              {{ Str::limit($review->body, 150) }}
            </p>

            <!-- Video Button (if available) -->
            @if($review->video_url)
              <a href="{{ $review->video_url }}" target="_blank" 
                class="mt-3 inline-block text-sm text-brand font-medium hover:underline">
                ▶ Watch Video Review
              </a>
            @endif

          </figcaption>

        </figure>
      @endforeach

    </div>
  </section>





  <!-- Seminar -->
  <section id="seminar" class="container mx-auto px-4 lg:px-8 py-12">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">

    <div>
      <h4 class="text-xl font-bold">Join Our Free Seminars</h4>
      <p class="mt-2 text-slate-600">
        Every week we arrange industry-oriented seminars where students learn about 
        trending skills, job opportunities, and real career pathways in the digital world.
      </p>

      <ul class="mt-4 space-y-2 text-slate-700 text-sm">
        <li class="flex items-start gap-2">
          <span class="text-brand mt-1">✔</span>  
          Understand which skill suits your future career.
        </li>
        <li class="flex items-start gap-2">
          <span class="text-brand mt-1">✔</span>
          Get a clear roadmap for freelancing & local job market.
        </li>
        <li class="flex items-start gap-2">
          <span class="text-brand mt-1">✔</span>
          Talk directly with mentors & ask your questions live.
        </li>
        <li class="flex items-start gap-2">
          <span class="text-brand mt-1">✔</span>
          Learn how to build a strong portfolio as a beginner.
        </li>
      </ul>

      <a href="#" class="mt-6 inline-block px-5 py-2.5 bg-brand text-white rounded-md shadow hover:shadow-lg transition">
        Register for Free
      </a>
    </div>

    <div>
      <img src="{{ asset('assets/img/home2.jpeg') }}" alt="seminar" class="rounded-lg shadow-lg" />
    </div>

  </div>
</section>


@endsection
