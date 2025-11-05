<!doctype html>
<html lang="bn">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'GenZ IT - Tailwind Responsive Template')</title>
  <meta name="description" content="Responsive Tailwind template based on GenZ IT homepage" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              DEFAULT: '#ef4444',
              50: '#fff1f1'
            }
          }
        }
      }
    }
  </script>
</head>
<body class="antialiased text-slate-800 bg-white">

  <!-- Header -->
  <header class="sticky top-0 z-40 bg-white shadow-sm">
    <div class="container mx-auto px-4 lg:px-8">
      <div class="flex items-center justify-between py-4">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
          <img src="https://placehold.co/48x48?text=CI" alt="logo" class="h-10 w-10 rounded-md object-cover" />
          <span class="font-semibold text-lg">GenZ IT</span>
        </a>

        <!-- Desktop nav -->
        <nav class="hidden lg:flex items-center gap-6">
          <a href="{{ url('/') }}" class="hover:text-brand {{ request()->is('/') ? 'text-brand font-semibold' : '' }}">Home</a>
          <a href="{{ route('course') }}" class="hover:text-brand {{ request()->is('courses') ? 'text-brand font-semibold' : '' }}">Courses</a>
          <a href="{{ route('success.stories') }}" class="hover:text-brand {{ request()->is('success-stories') ? 'text-brand font-semibold' : '' }}">Success</a>
          <a href="{{ route('about') }}" class="hover:text-brand {{ request()->is('about') ? 'text-brand font-semibold' : '' }}">About</a>
          <a href="{{ route('contact') }}" class="hover:text-brand {{ request()->is('contact') ? 'text-brand font-semibold' : '' }}">Contact</a>
        </nav>

        <div class="flex items-center gap-3">
          <a href="{{ route('admission') }}" class="hidden sm:inline-block bg-brand text-white px-4 py-2 rounded-md shadow">Admission Now</a>

          <!-- Mobile menu button -->
          <button id="mobileMenuBtn" class="inline-flex lg:hidden items-center justify-center p-2 rounded-md hover:bg-slate-100">
            <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile nav -->
      <div id="mobileMenu" class="hidden lg:hidden pb-4">
        <div class="flex flex-col gap-3">
          <a href="{{ url('/') }}" class="px-2 py-2 rounded hover:bg-slate-100">Home</a>
          <a href="{{ route('course') }}" class="px-2 py-2 rounded hover:bg-slate-100">Courses</a>
          <a href="{{ route('success.stories') }}" class="px-2 py-2 rounded hover:bg-slate-100">Success</a>
          <a href="{{ route('about') }}" class="px-2 py-2 rounded hover:bg-slate-100">About</a>
          <a href="{{ route('contact') }}" class="px-2 py-2 bg-brand text-white rounded">Contact</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  @yield('content')

  <!-- Footer -->
  <footer id="contact" class="bg-slate-900 text-slate-200 py-12 mt-12">
    <div class="container mx-auto px-4 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-6">
      <div>
        <h5 class="font-bold text-white">GenZ IT</h5>
        <p class="text-sm text-slate-400 mt-2">Address, phone, email here. Social links.</p>
      </div>
      <div>
        <h6 class="font-semibold">Quick Links</h6>
        <ul class="mt-3 text-sm text-slate-400 space-y-2">
          <li><a href="{{ route('course') }}" class="hover:underline">Courses</a></li>
          <li><a href="{{ route('about') }}" class="hover:underline">About</a></li>
          <li><a href="{{ route('contact') }}" class="hover:underline">Contact</a></li>
        </ul>
      </div>
      <div>
        <h6 class="font-semibold">Popular Courses</h6>
        <ul class="mt-3 text-sm text-slate-400 space-y-2">
          <li>Graphic Design</li>
          <li>Web Development</li>
          <li>Digital Marketing</li>
        </ul>
      </div>
      <div>
        <h6 class="font-semibold">Admission</h6>
        <p class="text-sm text-slate-400 mt-2">
          Admission is going on.
          <a href="{{ route('contact') }}" class="text-brand hover:underline">Apply Now</a>
        </p>
      </div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 mt-8 border-t border-slate-800 pt-6 text-sm text-slate-500">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div>© 2025 GenZ IT. All rights reserved.</div>
        <div class="flex items-center gap-4">
          <a href="#" class="hover:text-white">Facebook</a>
          <a href="#" class="hover:text-white">YouTube</a>
          <a href="#" class="hover:text-white">LinkedIn</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Mobile menu script -->
  <script>
    const btn = document.getElementById('mobileMenuBtn');
    const mobile = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');
    btn && btn.addEventListener('click', () => {
      mobile.classList.toggle('hidden');
      menuIcon.classList.toggle('hidden');
      closeIcon.classList.toggle('hidden');
    });
  </script>

</body>
</html>
