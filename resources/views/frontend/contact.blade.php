@extends('layouts.master')
@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-brand/10 to-white py-20 text-center">
  <div class="container mx-auto px-4">
    <h1 class="text-4xl md:text-5xl font-extrabold text-brand">Get in Touch</h1>
    <p class="text-slate-600 mt-3 max-w-2xl mx-auto">
      Have questions or want to work with us? Fill out the form below, and we’ll get back to you as soon as possible.
    </p>
  </div>
</section>

<!-- Contact Section -->
<section class="container mx-auto px-4 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- Contact Info -->
    <div class="space-y-6">
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 flex items-center justify-center bg-brand/10 text-brand rounded-full">
            📞
          </div>
          <div>
            <h4 class="font-semibold text-lg">Phone</h4>
            <p class="text-slate-600 text-sm">+880 1712-345678</p>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 flex items-center justify-center bg-brand/10 text-brand rounded-full">
            📧
          </div>
          <div>
            <h4 class="font-semibold text-lg">Email</h4>
            <p class="text-slate-600 text-sm">contact@growsoft.com</p>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 flex items-center justify-center bg-brand/10 text-brand rounded-full">
            📍
          </div>
          <div>
            <h4 class="font-semibold text-lg">Office Address</h4>
            <p class="text-slate-600 text-sm">Dhaka, Bangladesh</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Form -->
    <div class="lg:col-span-2 bg-white p-8 rounded-xl shadow-lg">
      <h2 class="text-2xl font-bold mb-6">Send us a Message</h2>
      <form action="#" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block font-medium mb-2">Full Name</label>
            <input type="text" name="name" required class="w-full border border-slate-300 rounded-md px-4 py-3 focus:ring-2 focus:ring-brand focus:outline-none">
          </div>
          <div>
            <label class="block font-medium mb-2">Email Address</label>
            <input type="email" name="email" required class="w-full border border-slate-300 rounded-md px-4 py-3 focus:ring-2 focus:ring-brand focus:outline-none">
          </div>
        </div>

        <div>
          <label class="block font-medium mb-2">Subject</label>
          <input type="text" name="subject" required class="w-full border border-slate-300 rounded-md px-4 py-3 focus:ring-2 focus:ring-brand focus:outline-none">
        </div>

        <div>
          <label class="block font-medium mb-2">Message</label>
          <textarea name="message" rows="5" required class="w-full border border-slate-300 rounded-md px-4 py-3 focus:ring-2 focus:ring-brand focus:outline-none"></textarea>
        </div>

        <button type="submit" class="w-full bg-brand text-white py-3 rounded-md shadow hover:bg-brand/90 transition">
          Send Message
        </button>
      </form>
    </div>

  </div>
</section>

<!-- Google Map -->
<section class="mt-12">
  <div class="container mx-auto px-4">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9033279482475!2d90.39123687455093!3d23.750859188809934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b894e1f37a7d%3A0x7a2a8200ddfbbd04!2sDhaka!5e0!3m2!1sen!2sbd!4v1695312023456!5m2!1sen!2sbd" 
      width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
  </div>
</section>

@endsection
