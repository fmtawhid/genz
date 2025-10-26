@extends('layouts.master')
@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-brand/10 to-white py-20 text-center">
  <div class="container mx-auto px-4">
    <h1 class="text-4xl md:text-5xl font-extrabold text-brand">Our Successful Students</h1>
    <p class="text-slate-600 mt-3 max-w-2xl mx-auto">
      Meet some of our amazing students who transformed their careers through GrowSoft’s training programs.
    </p>
  </div>
</section>

<!-- Success Stories Grid -->
<section class="container mx-auto px-4 py-16">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

    <!-- Story 1 -->
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 text-center">
      <img src="https://randomuser.me/api/portraits/men/11.jpg" alt="Student" class="w-28 h-28 mx-auto rounded-full object-cover shadow">
      <h3 class="font-semibold text-lg mt-4">Rifat Hossain</h3>
      <p class="text-brand text-sm font-medium">Full Stack Developer @TechFlow</p>
      <p class="text-slate-600 text-sm mt-3">“After completing the full-stack course, I landed my first remote job within 3 months! The mentorship was life-changing.”</p>
    </div>

    <!-- Story 2 -->
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 text-center">
      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Student" class="w-28 h-28 mx-auto rounded-full object-cover shadow">
      <h3 class="font-semibold text-lg mt-4">Sadia Akter</h3>
      <p class="text-brand text-sm font-medium">Frontend Engineer @CodeBase</p>
      <p class="text-slate-600 text-sm mt-3">“From beginner to professional — GrowSoft helped me master React and land a great position in Dhaka.”</p>
    </div>

    <!-- Story 3 -->
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 text-center">
      <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Student" class="w-28 h-28 mx-auto rounded-full object-cover shadow">
      <h3 class="font-semibold text-lg mt-4">Rakibul Islam</h3>
      <p class="text-brand text-sm font-medium">Backend Developer @SoftMind</p>
      <p class="text-slate-600 text-sm mt-3">“I built my confidence in Laravel and now work with clients globally. The course structure was outstanding.”</p>
    </div>

    <!-- Story 4 -->
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 text-center">
      <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Student" class="w-28 h-28 mx-auto rounded-full object-cover shadow">
      <h3 class="font-semibold text-lg mt-4">Mim Chowdhury</h3>
      <p class="text-brand text-sm font-medium">UI/UX Designer @CreativeHub</p>
      <p class="text-slate-600 text-sm mt-3">“Design learning was fun here! I created a strong portfolio and now work for an international agency.”</p>
    </div>

    <!-- Story 5 -->
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 text-center">
      <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student" class="w-28 h-28 mx-auto rounded-full object-cover shadow">
      <h3 class="font-semibold text-lg mt-4">Jubayer Khan</h3>
      <p class="text-brand text-sm font-medium">App Developer @NextGen Apps</p>
      <p class="text-slate-600 text-sm mt-3">“I started from scratch with Flutter and now I build real apps for startups — all thanks to GrowSoft.”</p>
    </div>

    <!-- Story 6 -->
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 text-center">
      <img src="https://randomuser.me/api/portraits/women/25.jpg" alt="Student" class="w-28 h-28 mx-auto rounded-full object-cover shadow">
      <h3 class="font-semibold text-lg mt-4">Nadia Rahman</h3>
      <p class="text-brand text-sm font-medium">Digital Marketer @Adnova</p>
      <p class="text-slate-600 text-sm mt-3">“The digital marketing bootcamp helped me land my first freelance clients within weeks!”</p>
    </div>

  </div>
</section>

<!-- CTA Section -->
<section class="bg-brand text-white py-16 text-center rounded-t-[3rem]">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold">Want to be our next success story?</h2>
    <p class="text-white/80 mt-3 max-w-2xl mx-auto">
      Join our hands-on learning programs and start your career transformation today.
    </p>
    <a href="/courses" class="mt-6 inline-block bg-white text-brand px-6 py-3 rounded-md font-semibold shadow hover:bg-slate-100 transition">
      Explore Courses
    </a>
  </div>
</section>

@endsection
