<!doctype html>
<html lang="bn">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>GenZ IT - Learn Professional Skills Online</title>
  <meta name="description" content="Learn professional skills in Graphic Design, Web Development, Digital Marketing and more from industry experts" />
  <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

<!-- HEADER -->
<header class="sticky top-0 z-40 bg-white shadow-sm">
  <div class="container mx-auto px-4 lg:px-8">

    <div class="flex items-center justify-between py-4">

      <!-- LOGO -->
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <img src="https://placehold.co/48x48?text=CI"
             alt="logo"
             class="h-10 w-10 rounded-md object-cover" />
        <span class="font-semibold text-lg">GenZ IT</span>
      </a>

      <!-- DESKTOP MENU -->
      <nav class="hidden lg:flex items-center gap-6">

        <a href="{{ route('home') }}"
           class="{{ request()->routeIs('home') ? 'text-brand font-semibold' : 'hover:text-brand' }}">
          Home
        </a>

        <a href="{{ route('courses') }}"
           class="{{ request()->routeIs('courses') ? 'text-brand font-semibold' : 'hover:text-brand' }}">
          Courses
        </a>

        <a href="{{ route('success.stories') }}"
           class="{{ request()->routeIs('success.stories') ? 'text-brand font-semibold' : 'hover:text-brand' }}">
          Success Stories
        </a>

        <a href="{{ route('about') }}"
           class="{{ request()->routeIs('about') ? 'text-brand font-semibold' : 'hover:text-brand' }}">
          About
        </a>

        <a href="{{ route('contact') }}"
           class="{{ request()->routeIs('contact') ? 'text-brand font-semibold' : 'hover:text-brand' }}">
          Contact
        </a>

      </nav>

      <!-- RIGHT SIDE -->
      <div class="flex items-center gap-3">

        @guest
          <a href="{{ route('login') }}"
             class="hidden sm:inline-block text-slate-700 px-4 py-2 rounded-md hover:bg-slate-100">
            Login
          </a>

          <a href="{{ route('register') }}"
             class="hidden sm:inline-block bg-brand text-white px-4 py-2 rounded-md shadow">
            Register
          </a>
        @else
          <a href="{{ route('merchant.index') }}"
             class="hidden sm:inline-block bg-brand text-white px-4 py-2 rounded-md shadow">
            Dashboard
          </a>
        @endguest

        <!-- MOBILE BUTTON -->
        <button id="mobileMenuBtn"
                class="inline-flex lg:hidden items-center justify-center p-2 rounded-md hover:bg-slate-100">

          <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>

          <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden"
               fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
          </svg>

        </button>

      </div>

    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden lg:hidden pb-4">

      <div class="flex flex-col gap-3">

        <a href="{{ route('home') }}"
           class="px-2 py-2 rounded hover:bg-slate-100">
          Home
        </a>

        <a href="{{ route('courses') }}"
           class="px-2 py-2 rounded hover:bg-slate-100">
          Courses
        </a>

        <a href="{{ route('success.stories') }}"
           class="px-2 py-2 rounded hover:bg-slate-100">
          Success
        </a>

        <a href="{{ route('about') }}"
           class="px-2 py-2 rounded hover:bg-slate-100">
          About
        </a>

        <a href="{{ route('contact') }}"
           class="px-2 py-2 bg-brand text-white rounded">
          Contact
        </a>

      </div>

    </div>

  </div>
</header>

<!-- PAGE CONTENT -->
@yield('body')

<!-- FOOTER -->
<footer class="bg-slate-900 text-slate-200 py-12 mt-12">

  <div class="container mx-auto px-4 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-6">

    <div>
      <h5 class="font-bold text-white">GenZ IT</h5>
      <p class="text-sm text-slate-400 mt-2">
        Learn skills, build career, grow online.
      </p>
    </div>

    <div>
      <h6 class="font-semibold">Quick Links</h6>
      <ul class="mt-3 text-sm text-slate-400 space-y-2">
        <li><a href="{{ route('courses') }}" class="hover:underline">Courses</a></li>
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

<!-- MOBILE SCRIPT -->
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