<!DOCTYPE html>
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
              50: '#fff1f1',
              600: '#dc2626',
              700: '#b91c1c'
            }
          },
          fontFamily: {
            'sans': ['Inter', 'system-ui', 'Segoe UI', 'sans-serif']
          },
          animation: {
            'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
          }
        }
      }
    }
  </script>
  <style>
    /* subtle custom scroll & smooth hover */
    .footer-social-icon {
      transition: all 0.2s ease-in-out;
    }
    .footer-social-icon:hover {
      transform: translateY(-2px);
    }
  </style>
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
             class="h-10 w-10 rounded-md object-cover shadow-sm" />
        <span class="font-bold text-xl tracking-tight text-slate-800">GenZ IT</span>
      </a>

      <!-- DESKTOP MENU -->
      <nav class="hidden lg:flex items-center gap-6">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand font-semibold border-b-2 border-brand' : 'hover:text-brand transition' }}">Home</a>
        <a href="{{ route('courses') }}" class="{{ request()->routeIs('courses') ? 'text-brand font-semibold border-b-2 border-brand' : 'hover:text-brand transition' }}">Courses</a>
        <a href="{{ route('success.stories') }}" class="{{ request()->routeIs('success.stories') ? 'text-brand font-semibold border-b-2 border-brand' : 'hover:text-brand transition' }}">Success Stories</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-brand font-semibold border-b-2 border-brand' : 'hover:text-brand transition' }}">About</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-brand font-semibold border-b-2 border-brand' : 'hover:text-brand transition' }}">Contact</a>
      </nav>

      <!-- RIGHT SIDE -->
      <div class="flex items-center gap-3">
        @guest
          <a href="{{ route('login') }}" class="hidden sm:inline-block text-slate-700 px-4 py-2 rounded-md hover:bg-slate-100 transition">Login</a>
          <a href="{{ route('register') }}" class="hidden sm:inline-block bg-brand text-white px-4 py-2 rounded-md shadow hover:bg-brand-600 transition">Register</a>
        @else
          <a href="{{ route('merchant.index') }}" class="hidden sm:inline-block bg-brand text-white px-4 py-2 rounded-md shadow hover:bg-brand-600 transition">Dashboard</a>
        @endguest

        <!-- MOBILE BUTTON -->
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

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden lg:hidden pb-4">
      <div class="flex flex-col gap-3">
        <a href="{{ route('home') }}" class="px-2 py-2 rounded hover:bg-slate-100 transition">Home</a>
        <a href="{{ route('courses') }}" class="px-2 py-2 rounded hover:bg-slate-100 transition">Courses</a>
        <a href="{{ route('success.stories') }}" class="px-2 py-2 rounded hover:bg-slate-100 transition">Success</a>
        <a href="{{ route('about') }}" class="px-2 py-2 rounded hover:bg-slate-100 transition">About</a>
        <a href="{{ route('contact') }}" class="px-2 py-2 bg-brand text-white rounded-md text-center transition">Contact</a>
      </div>
    </div>
  </div>
</header>

<!-- PAGE CONTENT -->
@yield('body')

<!-- ========== UPDATED FOOTER - MODERN DESIGN ========== -->
<footer class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-slate-200 pt-16 pb-8 mt-16 overflow-hidden">
  
  <!-- decorative glowing orb effect (subtle) -->
  <div class="absolute top-0 left-1/4 w-96 h-96 bg-brand/5 rounded-full blur-3xl -z-0"></div>
  <div class="absolute bottom-0 right-0 w-80 h-80 bg-brand/10 rounded-full blur-2xl -z-0"></div>

  <div class="container mx-auto px-4 lg:px-8 relative z-10">
    
    <!-- main footer grid: 4 columns with improved layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

      <!-- COLUMN 1: BRAND + CONTACT INFO -->
      <div class="space-y-5">
        <div class="flex items-center gap-2">
          <div class="h-9 w-9 bg-brand rounded-lg flex items-center justify-center shadow-md">
            <i class="fas fa-code text-white text-sm"></i>
          </div>
          <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">GenZ IT</span>
        </div>
        <p class="text-slate-300 text-sm leading-relaxed">
          Empowering Gen Z with future-ready IT skills. Learn from industry experts and build your digital career.
        </p>
        
        <!-- contact details with icons -->
        <div class="space-y-3 pt-1">
          <div class="flex items-center gap-3 text-slate-300 text-sm hover:text-brand transition group">
            <i class="fas fa-map-marker-alt w-4 text-brand/80 group-hover:text-brand"></i>
            <span>House 12, Road 05, Dhaka, Bangladesh</span>
          </div>
          <div class="flex items-center gap-3 text-slate-300 text-sm hover:text-brand transition group">
            <i class="fas fa-envelope w-4 text-brand/80 group-hover:text-brand"></i>
            <a href="mailto:hello@genzit.com" class="hover:text-white">hello@genzit.com</a>
          </div>
          <div class="flex items-center gap-3 text-slate-300 text-sm hover:text-brand transition group">
            <i class="fas fa-phone-alt w-4 text-brand/80 group-hover:text-brand"></i>
            <a href="tel:+8801234567890" class="hover:text-white">+880 1234 567890</a>
          </div>
        </div>
      </div>

      <!-- COLUMN 2: QUICK LINKS (useful pages) -->
      <div>
        <h5 class="text-white font-semibold text-lg flex items-center gap-2 border-l-3 border-brand pl-3" style="border-left-width: 3px;">
          <i class="fas fa-link text-brand text-sm"></i> Quick Links
        </h5>
        <ul class="mt-5 space-y-3">
          <li><a href="{{ route('home') }}" class="text-slate-300 hover:text-brand transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-xs text-brand/60 group-hover:text-brand transition"></i> Home</a></li>
          <li><a href="{{ route('courses') }}" class="text-slate-300 hover:text-brand transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-xs text-brand/60 group-hover:text-brand transition"></i> All Courses</a></li>
          <li><a href="{{ route('success.stories') }}" class="text-slate-300 hover:text-brand transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-xs text-brand/60 group-hover:text-brand transition"></i> Success Stories</a></li>
          <li><a href="{{ route('about') }}" class="text-slate-300 hover:text-brand transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-xs text-brand/60 group-hover:text-brand transition"></i> About GenZ IT</a></li>
          <li><a href="{{ route('contact') }}" class="text-slate-300 hover:text-brand transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-xs text-brand/60 group-hover:text-brand transition"></i> Contact Support</a></li>
        </ul>
      </div>

      <!-- COLUMN 3: POPULAR COURSES with interactive badges -->
      <div>
        <h5 class="text-white font-semibold text-lg flex items-center gap-2 border-l-3 border-brand pl-3" style="border-left-width: 3px;">
          <i class="fas fa-graduation-cap text-brand text-sm"></i> Top Courses
        </h5>
        <ul class="mt-5 space-y-3">
          @foreach (\App\Models\Course::all()->take(5) as $course)
          <li class="flex items-center justify-between group cursor-default">
            <span class="text-slate-300 group-hover:text-brand transition">{{ $course->title }}</span>
            <span class="text-xs bg-slate-700/60 px-2 py-0.5 rounded-full text-brand-300">{{ $course->level }}</span>
          </li>
          @endforeach
          
        </ul>
        <div class="mt-5">
          <a href="{{ route('courses') }}" class="inline-flex items-center text-sm text-brand hover:text-white transition gap-1 group">
            Browse all courses <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
          </a>
        </div>
      </div>

      <!-- COLUMN 4: ADMISSION + SOCIAL MEDIA (combined) -->
      <div class="space-y-6">
        <!-- admission card -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
          <div class="flex items-center justify-between">
            <h5 class="text-white font-bold flex items-center gap-2">
              <i class="fas fa-rocket text-brand"></i> 
              Admission Open
            </h5>
            <span class="bg-brand/20 text-brand text-xs px-2 py-0.5 rounded-full animate-pulse">Limited Seats</span>
          </div>
          <p class="text-slate-300 text-sm mt-2 leading-relaxed">
            Start your journey with exclusive 20% early bird discount. Industry-ready curriculum, live projects & career mentorship.
          </p>
          <a href="{{ route('admission') }}" class="mt-3 inline-flex items-center gap-1 bg-brand hover:bg-brand-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-md w-full justify-center">
            Apply Now <i class="fas fa-chevron-right text-xs"></i>
          </a>
        </div>

        <!-- Social Media Section -->
        <div>
          <h5 class="text-white font-semibold text-lg flex items-center gap-2 mb-3">
            <i class="fas fa-share-alt text-brand"></i> Connect With Us
          </h5>
          <div class="flex flex-wrap gap-3">
            <a href="#" class="footer-social-icon bg-slate-800 hover:bg-brand w-10 h-10 rounded-full flex items-center justify-center text-slate-200 hover:text-white transition-all shadow-md">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="footer-social-icon bg-slate-800 hover:bg-brand w-10 h-10 rounded-full flex items-center justify-center text-slate-200 hover:text-white transition-all shadow-md">
              <i class="fab fa-youtube"></i>
            </a>
            <a href="#" class="footer-social-icon bg-slate-800 hover:bg-brand w-10 h-10 rounded-full flex items-center justify-center text-slate-200 hover:text-white transition-all shadow-md">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#" class="footer-social-icon bg-slate-800 hover:bg-brand w-10 h-10 rounded-full flex items-center justify-center text-slate-200 hover:text-white transition-all shadow-md">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="footer-social-icon bg-slate-800 hover:bg-brand w-10 h-10 rounded-full flex items-center justify-center text-slate-200 hover:text-white transition-all shadow-md">
              <i class="fab fa-x-twitter"></i>
            </a>
          </div>
          <p class="text-xs text-slate-400 mt-3 flex items-center gap-1">
            <i class="fas fa-globe text-brand"></i> Join 5k+ learners community
          </p>
        </div>
      </div>
    </div>

    <!-- Divider with brand gradient -->
    <div class="relative my-10">
      <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-slate-700/70"></div>
      </div>
      <div class="relative flex justify-center">
        <span class="bg-gradient-to-r from-slate-800 to-slate-800 px-4 text-sm text-slate-400">
          <i class="fas fa-laptop-code text-brand/70"></i>
        </span>
      </div>
    </div>

    <!-- BOTTOM COPYRIGHT ROW with extra features -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm">
      <div class="text-slate-400 flex flex-wrap items-center gap-2">
        <span>© 2025 GenZ IT — All rights reserved.</span>
        <span class="hidden md:inline text-slate-600">|</span>
        <div class="flex gap-3 text-xs">
          <a href="#" class="hover:text-brand transition">Privacy Policy</a>
          <a href="#" class="hover:text-brand transition">Terms of Service</a>
          <a href="#" class="hover:text-brand transition">Refund Policy</a>
        </div>
      </div>
      
      <div class="flex items-center gap-5">
        <!-- payment / secure badge (design touch) -->
        <div class="flex items-center gap-1 text-slate-400 text-xs bg-slate-800/50 px-2 py-1 rounded-full">
          <i class="fab fa-cc-visa"></i>
          <i class="fab fa-cc-mastercard"></i>
          <i class="fab fa-cc-paypal"></i>
          <span class="ml-1">Secure SSL</span>
        </div>
        <!-- scroll to top button (functional) -->
        <button id="backToTop" class="bg-slate-800 hover:bg-brand text-slate-300 hover:text-white transition-all rounded-full w-8 h-8 flex items-center justify-center shadow-md">
          <i class="fas fa-arrow-up text-xs"></i>
        </button>
      </div>
    </div>
  </div>
</footer>

<!-- MOBILE MENU + BACK TO TOP SCRIPT -->
<script>
  // mobile menu toggle
  const btn = document.getElementById('mobileMenuBtn');
  const mobile = document.getElementById('mobileMenu');
  const menuIcon = document.getElementById('menuIcon');
  const closeIcon = document.getElementById('closeIcon');

  if (btn) {
    btn.addEventListener('click', () => {
      mobile.classList.toggle('hidden');
      menuIcon.classList.toggle('hidden');
      closeIcon.classList.toggle('hidden');
    });
  }

  // Back to top button smooth scroll
  const backToTopBtn = document.getElementById('backToTop');
  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // optional: show back to top only on scroll (nice gesture)
  window.addEventListener('scroll', () => {
    if (backToTopBtn) {
      if (window.scrollY > 500) {
        backToTopBtn.classList.remove('opacity-0', 'invisible');
        backToTopBtn.classList.add('opacity-100', 'visible');
      } else {
        backToTopBtn.classList.add('opacity-0', 'invisible');
        backToTopBtn.classList.remove('opacity-100', 'visible');
      }
    }
  });
  // initial style for back to top (hidden till scroll)
  if (backToTopBtn) {
    backToTopBtn.classList.add('opacity-0', 'invisible', 'transition-all', 'duration-300');
    // force reflow / default hidden
  }
</script>

<style>
  /* Back to top smooth visibility */
  #backToTop.visible {
    opacity: 1 !important;
    visibility: visible !important;
  }
  #backToTop.invisible {
    opacity: 0;
    visibility: hidden;
  }
  /* border-left custom helper */
  .border-l-3 {
    border-left-width: 3px;
  }
  /* custom hover animations for footer */
  .footer-social-icon {
    transition: all 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
  }
  .footer-social-icon:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px -6px rgba(239, 68, 68, 0.3);
  }
</style>
</body>
</html>