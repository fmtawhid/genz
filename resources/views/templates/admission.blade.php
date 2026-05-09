@extends('templates.layouts.master')
@section('body')

<!-- HERO -->
<section class="bg-gradient-to-r from-red-50 to-white py-16 text-center">
  <div class="max-w-3xl mx-auto px-4">
    <h1 class="text-4xl font-bold text-red-500">Admission Open</h1>
    <p class="mt-4 text-slate-600">
      Learn high-income skills & start earning in 3–6 months. Limited seats available.
    </p>
  </div>
</section>

<!-- MAIN -->
<section class="max-w-6xl mx-auto px-4 py-16 grid lg:grid-cols-2 gap-10">

<!-- FORM -->
<div class="bg-white shadow-xl rounded-xl p-8">

<h2 class="text-2xl font-bold text-red-500 mb-6">Apply Now</h2>

<form class="space-y-5">

<input type="text" placeholder="Full Name *" required class="w-full border p-3 rounded">

<input type="email" placeholder="Email Address" class="w-full border p-3 rounded">

<input type="text" placeholder="Phone Number *" required class="w-full border p-3 rounded">

<select class="w-full border p-3 rounded" required>
<option>Select Course</option>
<option>Web Development</option>
<option>Graphic Design</option>
<option>Digital Marketing</option>
<option>App Development</option>
</select>

<select class="w-full border p-3 rounded">
<option>Batch Time</option>
<option>Morning</option>
<option>Evening</option>
<option>Weekend</option>
</select>

<textarea placeholder="Your Goal / Why join?" class="w-full border p-3 rounded"></textarea>

<button class="w-full bg-red-500 text-white py-3 rounded font-semibold">
Submit Application
</button>

</form>
</div>

<!-- INFO -->
<div class="bg-red-50 p-8 rounded-xl">

<h3 class="text-2xl font-bold text-red-500">Why Join GenZ IT?</h3>

<ul class="mt-6 space-y-3 text-sm">
<li>✔ Real Client Projects</li>
<li>✔ Freelancing Roadmap</li>
<li>✔ Job Support</li>
<li>✔ Live + Recorded Classes</li>
<li>✔ Certificate</li>
</ul>

<div class="mt-8">
<h4 class="font-semibold">Course Info</h4>
<p class="text-sm mt-2">Duration: 3–6 Months</p>
<p class="text-sm">Admission Fee: ৳500</p>
</div>

<div class="mt-8 p-4 bg-white rounded shadow text-center">
<p class="text-sm">Need Help?</p>
<a href="#" class="text-red-500 font-semibold">Chat on WhatsApp</a>
</div>

</div>

</section>

<!-- TRUST -->
<section class="bg-slate-50 py-12 text-center">
<div class="max-w-4xl mx-auto px-4 grid md:grid-cols-3 gap-6">

<div class="p-5 shadow rounded">
<h3 class="text-2xl font-bold">5000+</h3>
<p class="text-sm">Students</p>
</div>

<div class="p-5 shadow rounded">
<h3 class="text-2xl font-bold">10000+</h3>
<p class="text-sm">Projects</p>
</div>

<div class="p-5 shadow rounded">
<h3 class="text-2xl font-bold">80%</h3>
<p class="text-sm">Success Rate</p>
</div>

</div>
</section>

@endsection