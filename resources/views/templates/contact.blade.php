@extends('templates.layouts.master')
@section('body')
<!-- HERO -->
<section class="bg-gradient-to-r from-red-50 to-white py-16 text-center">
  <div class="max-w-3xl mx-auto px-4">
    <h1 class="text-4xl font-bold text-red-500">Contact Us</h1>
    <p class="mt-4 text-slate-600">
      Have questions? Talk with us directly or send a message.
    </p>
  </div>
</section>

<!-- CONTACT -->
<section class="max-w-6xl mx-auto px-4 py-16 grid lg:grid-cols-3 gap-10">

<!-- LEFT INFO -->
<div class="space-y-6">

<div class="p-5 shadow rounded flex gap-4 items-center">
<div class="text-red-500 text-2xl">📞</div>
<div>
<h4 class="font-semibold">Phone</h4>
<p class="text-sm">+8801712345678</p>
</div>
</div>

<div class="p-5 shadow rounded flex gap-4 items-center">
<div class="text-red-500 text-2xl">📧</div>
<div>
<h4 class="font-semibold">Email</h4>
<p class="text-sm">contact@genzit.com</p>
</div>
</div>

<div class="p-5 shadow rounded flex gap-4 items-center">
<div class="text-red-500 text-2xl">📍</div>
<div>
<h4 class="font-semibold">Address</h4>
<p class="text-sm">Dhaka, Bangladesh</p>
</div>
</div>

<!-- WHATSAPP -->
<div class="p-5 bg-red-50 rounded text-center">
<p class="text-sm">Need instant reply?</p>
<a href="https://wa.me/880XXXXXXXXXX" class="text-red-500 font-semibold">
Chat on WhatsApp
</a>
</div>

</div>

<!-- FORM -->
<div class="lg:col-span-2 bg-white p-8 rounded-xl shadow">

<h2 class="text-2xl font-bold mb-6">Send Message</h2>

<form class="space-y-5">

<input type="text" placeholder="Full Name *" required class="w-full border p-3 rounded">

<input type="text" placeholder="Phone Number *" required class="w-full border p-3 rounded">

<textarea placeholder="Your Message *" rows="5" required class="w-full border p-3 rounded"></textarea>

<button class="w-full bg-red-500 text-white py-3 rounded font-semibold">
Send Message
</button>

</form>

</div>

</section>

<!-- MAP -->
<section class="px-4 pb-16">
<div class="max-w-6xl mx-auto">
<iframe
src="https://www.google.com/maps?q=Dhaka&output=embed"
width="100%" height="350" style="border:0;">
</iframe>
</div>
</section>

<!-- CTA -->
<section class="bg-red-500 text-white py-16 text-center">
<h2 class="text-3xl font-bold">Still Confused?</h2>
<p class="mt-3 text-white/80">Join our free seminar & get clear direction</p>
<a href="#" class="mt-6 inline-block bg-white text-red-500 px-6 py-3 rounded font-semibold">
Join Free Seminar
</a>
</section>
@endsection