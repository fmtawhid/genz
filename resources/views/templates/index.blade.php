@extends('templates.layouts.master')

@section('body')

<!-- Hero Section with Background Image & Animation -->
<section class="relative bg-fixed bg-cover bg-center bg-no-repeat"
         style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
    <div class="container mx-auto px-4 lg:px-8 py-20 lg:py-32 relative z-10">
        <div class="max-w-3xl text-white animate-fadeInUp">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight">
                Become an IT Pro & <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">Rule the Digital World</span>
            </h1>
            <p class="mt-4 text-lg text-gray-200">
                Hands-on courses, real projects, and job support to kickstart your career in design, development, and digital marketing.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('courses') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-brand to-orange-500 text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Explore Courses <i class="fas fa-arrow-right"></i>
                </a>
                <a href="{{ route('admission') }}" class="inline-flex items-center gap-2 border border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-brand transition-all duration-300">
                    Apply Now <i class="fas fa-user-graduate"></i>
                </a>
            </div>
            <div class="mt-10 flex flex-wrap gap-3">
                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm text-white">Graphic Design</span>
                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm text-white">Motion Graphics</span>
                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm text-white">Web Development</span>
                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm text-white">Digital Marketing</span>
            </div>
        </div>
    </div>
    <!-- Floating animated shape -->
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Popular Courses Section with Animated Cards -->
<section id="courses" class="container mx-auto px-4 lg:px-8 py-16 lg:py-24">
    <div class="text-center animate-fadeInUp">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">🔥 Popular Courses</h2>
        <p class="text-gray-500 mt-2 max-w-2xl mx-auto">Top picks crafted for learners & career builders – updated regularly</p>
    </div>
    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($courses as $course)
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100 animate-fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="relative overflow-hidden h-52">
                <img src="{{ $course->thumbnail ? asset($course->thumbnail) : 'https://placehold.co/600x400?text='.urlencode($course->title) }}"
                     alt="{{ $course->title }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <span class="absolute top-4 left-4 bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">{{ $course->level ?? 'All Levels' }}</span>
            </div>
            <div class="p-5">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex text-yellow-400">
                        @for($i=1; $i<=5; $i++)
                            <i class="fas fa-star {{ $i <= ($course->rating ?? 4) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                        <span class="text-gray-500 ml-2">({{ $course->reviews_count ?? 24 }})</span>
                    </div>
                    <span class="text-gray-500"><i class="far fa-clock"></i> {{ $course->duration ?? '10' }} hrs</span>
                </div>
                <h3 class="font-bold text-xl text-gray-800 mt-2 line-clamp-1">{{ $course->title }}</h3>
                <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $course->short_description ?? $course->description ?? 'No description' }}</p>
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <span class="text-2xl font-bold text-gray-800">৳{{ number_format($course->price ?? 0) }}</span>
                        @if($course->old_price)
                            <span class="text-sm text-gray-400 line-through ml-2">৳{{ number_format($course->old_price) }}</span>
                        @endif
                    </div>
                    <a href="{{ route('course.details', $course->slug) }}"
                       class="px-4 py-2 bg-brand/10 text-brand rounded-lg text-sm font-semibold hover:bg-brand hover:text-white transition-all duration-300">
                        Enroll Now
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500">No courses available yet. Check back soon!</p>
        </div>
        @endforelse
    </div>
    <div class="text-center mt-12">
        <a href="{{ route('courses') }}" class="inline-flex items-center gap-2 text-brand font-semibold border-b-2 border-brand pb-1 hover:gap-3 transition-all">
            Browse All Courses <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

<!-- Why Choose Us (Enhanced with icons and animations) -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center animate-fadeInUp">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Why Choose Us</h2>
            <p class="text-gray-500 mt-2 max-w-2xl mx-auto">We help students grow with practical learning & career support</p>
        </div>
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group animate-fadeInUp">
                <div class="w-14 h-14 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand group-hover:text-white transition">
                    <i class="fas fa-laptop-code text-2xl text-brand group-hover:text-white"></i>
                </div>
                <h4 class="text-xl font-semibold mt-4">Project-Based Learning</h4>
                <p class="text-gray-500 mt-2">Hands-on training with real-world projects & instructor guidance.</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group animate-fadeInUp" style="animation-delay: 0.1s">
                <div class="w-14 h-14 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand group-hover:text-white transition">
                    <i class="fas fa-chalkboard-user text-2xl text-brand group-hover:text-white"></i>
                </div>
                <h4 class="text-xl font-semibold mt-4">Expert Instructors</h4>
                <p class="text-gray-500 mt-2">Learn from highly experienced and industry-certified trainers.</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group animate-fadeInUp" style="animation-delay: 0.2s">
                <div class="w-14 h-14 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand group-hover:text-white transition">
                    <i class="fas fa-book-open text-2xl text-brand group-hover:text-white"></i>
                </div>
                <h4 class="text-xl font-semibold mt-4">Modern Curriculum</h4>
                <p class="text-gray-500 mt-2">Updated course materials designed for today's job market.</p>
            </div>
            <!-- Card 4 -->
            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group animate-fadeInUp" style="animation-delay: 0.3s">
                <div class="w-14 h-14 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand group-hover:text-white transition">
                    <i class="fas fa-users text-2xl text-brand group-hover:text-white"></i>
                </div>
                <h4 class="text-xl font-semibold mt-4">Small Batches</h4>
                <p class="text-gray-500 mt-2">Focused sessions ensuring personal attention for every student.</p>
            </div>
            <!-- Card 5 -->
            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group animate-fadeInUp" style="animation-delay: 0.4s">
                <div class="w-14 h-14 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand group-hover:text-white transition">
                    <i class="fas fa-briefcase text-2xl text-brand group-hover:text-white"></i>
                </div>
                <h4 class="text-xl font-semibold mt-4">Job Placement Support</h4>
                <p class="text-gray-500 mt-2">CV review, portfolio building & interview preparation.</p>
            </div>
            <!-- Card 6 -->
            <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group animate-fadeInUp" style="animation-delay: 0.5s">
                <div class="w-14 h-14 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand group-hover:text-white transition">
                    <i class="fas fa-calendar-alt text-2xl text-brand group-hover:text-white"></i>
                </div>
                <h4 class="text-xl font-semibold mt-4">Flexible Schedule</h4>
                <p class="text-gray-500 mt-2">Weekend & evening batches suitable for busy learners.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter with Animation (auto increment on scroll) -->
<section class="container mx-auto px-4 lg:px-8 py-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
        <div class="bg-gradient-to-br from-brand/5 to-white p-6 rounded-2xl shadow-sm hover:shadow-md transition animate-fadeInUp">
            <div class="text-4xl font-extrabold text-brand"><span class="counter" data-target="20000">0</span>+</div>
            <div class="text-gray-500 mt-1">Students Trained</div>
        </div>
        <div class="bg-gradient-to-br from-brand/5 to-white p-6 rounded-2xl shadow-sm hover:shadow-md transition animate-fadeInUp" style="animation-delay: 0.1s">
            <div class="text-4xl font-extrabold text-brand"><span class="counter" data-target="42000">0</span>+</div>
            <div class="text-gray-500 mt-1">Projects Completed</div>
        </div>
        <div class="bg-gradient-to-br from-brand/5 to-white p-6 rounded-2xl shadow-sm hover:shadow-md transition animate-fadeInUp" style="animation-delay: 0.2s">
            <div class="text-4xl font-extrabold text-brand"><span class="counter" data-target="89">0</span>%</div>
            <div class="text-gray-500 mt-1">Placement Rate</div>
        </div>
        <div class="bg-gradient-to-br from-brand/5 to-white p-6 rounded-2xl shadow-sm hover:shadow-md transition animate-fadeInUp" style="animation-delay: 0.3s">
            <div class="text-4xl font-extrabold text-brand"><span class="counter" data-target="150">0</span>+</div>
            <div class="text-gray-500 mt-1">Expert Instructors</div>
        </div>
    </div>
</section>

<!-- Success Stories / Testimonials Carousel (using simple flex with auto-scroll, or static grid) -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center animate-fadeInUp">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Success Stories</h2>
            <p class="text-gray-500 mt-2">Real people, real results – from our students</p>
        </div>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($reviews as $review)
                <article class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 animate-fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $review->name }}</h4>
                            <p class="text-sm text-brand">{{ $review->profession }}</p>
                        </div>
                        <div class="text-yellow-400 flex text-sm" aria-label="{{ $review->rating }} out of 5 stars">
                            @for($star = 1; $star <= 5; $star++)
                                <i class="fas fa-star {{ $star <= $review->rating ? '' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600 italic">“{{ $review->message }}”</p>
                </article>
            @empty
                <p class="col-span-full text-center text-gray-500">Reviews will appear here soon.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Free Seminar Section with Gradient Card -->
<section id="seminar" class="container mx-auto px-4 lg:px-8 py-16">
    <div class="bg-gradient-to-r from-brand/10 via-white to-brand/5 rounded-3xl shadow-xl overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center p-6 lg:p-12">
            <div>
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">Join Our Free Seminars</h4>
                <p class="mt-2 text-gray-600">Every week we arrange industry-oriented seminars where students learn about trending skills, job opportunities, and real career pathways.</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-center gap-2"><i class="fas fa-check-circle text-brand"></i> Understand which skill suits your future career.</li>
                    <li class="flex items-center gap-2"><i class="fas fa-check-circle text-brand"></i> Get a clear roadmap for freelancing & local job market.</li>
                    <li class="flex items-center gap-2"><i class="fas fa-check-circle text-brand"></i> Talk directly with mentors & ask your questions live.</li>
                    <li class="flex items-center gap-2"><i class="fas fa-check-circle text-brand"></i> Learn how to build a strong portfolio as a beginner.</li>
                </ul>
                <a href="#" class="mt-8 inline-flex items-center gap-2 bg-brand text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Register for Free <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="flex justify-center">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Seminar" class="rounded-2xl shadow-2xl max-w-full h-auto">
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="bg-brand py-16 lg:py-20">
    <div class="container mx-auto px-4 lg:px-8 text-center">
        <h3 class="text-2xl lg:text-3xl font-bold text-white">Stay Updated with Latest Courses & Offers</h3>
        <p class="text-brand-100 mt-2">Subscribe to our newsletter and get 10% off your first course.</p>
        <form action="#" method="POST" class="mt-8 max-w-md mx-auto flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="email" name="email" placeholder="Your email address" required
                   class="flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
            <button type="submit" class="bg-white text-brand px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-md">
                Subscribe
            </button>
        </form>
        <p class="text-xs text-brand-100 mt-4">We respect your privacy. Unsubscribe at any time.</p>
    </div>
</section>

<!-- Custom CSS for Animations -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0; /* start invisible */
    }
    /* Ensure all elements with this class become visible after animation */
    .animate-fadeInUp {
        opacity: 0;
    }
</style>

<!-- JavaScript for Counter Animation on Scroll -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter animation using Intersection Observer
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // lower = faster

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const updateCount = () => {
                        const target = parseInt(counter.getAttribute('data-target'));
                        const count = parseInt(counter.innerText);
                        const increment = Math.ceil(target / speed);
                        if (count < target) {
                            counter.innerText = count + increment;
                            setTimeout(updateCount, 20);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                    observer.unobserve(counter); // run only once
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    });
</script>

@endsection