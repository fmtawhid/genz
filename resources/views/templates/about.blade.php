@extends('templates.layouts.master')

@section('body')

<!-- Hero Section with Background Image -->
<section class="relative bg-cover bg-center bg-no-repeat"
         style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
    <div class="container mx-auto px-4 lg:px-8 py-20 lg:py-28 text-center lg:text-left relative z-10">
        <div class="max-w-3xl animate-fadeInUp">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white">
                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">GenZ IT</span>
            </h1>
            <p class="mt-4 text-lg text-gray-200">
                We help students learn high-income digital skills and start earning through freelancing and jobs.
            </p>
            <div class="mt-8 flex flex-wrap gap-4 justify-center lg:justify-start">
                <a href="#mission" class="inline-flex items-center gap-2 bg-brand hover:bg-brand/90 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    Our Mission <i class="fas fa-arrow-down"></i>
                </a>
                <a href="#team" class="inline-flex items-center gap-2 border border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-brand transition-all duration-300">
                    Meet Team <i class="fas fa-users"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section id="mission" class="container mx-auto px-4 lg:px-8 py-16 lg:py-24">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="animate-fadeInUp">
            <div class="relative">
                <div class="absolute -top-4 -left-4 w-24 h-24 bg-brand/10 rounded-full blur-2xl"></div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 relative">Our Mission</h2>
            </div>
            <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                Our mission is to teach practical, job-ready skills that help students earn money online or secure employment quickly. We focus on real-world projects and modern tools.
            </p>
            <div class="mt-8 relative">
                <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-brand/5 rounded-full blur-xl"></div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Our Vision</h2>
            </div>
            <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                To become a leading digital skills institute, empowering thousands of students to build successful careers and become self-reliant.
            </p>
        </div>
        <div class="grid gap-5 animate-fadeInUp" style="animation-delay: 0.2s">
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-brand group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand transition-colors">
                        <i class="fas fa-laptop-code text-2xl text-brand group-hover:text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-800">Hands-on Learning</h4>
                        <p class="text-gray-500 mt-1">Real projects, live assignments, and portfolio building included.</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-brand group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand transition-colors">
                        <i class="fas fa-chalkboard-user text-2xl text-brand group-hover:text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-800">Expert Mentors</h4>
                        <p class="text-gray-500 mt-1">Learn from industry professionals with years of experience.</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-brand group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-brand/10 rounded-xl flex items-center justify-center group-hover:bg-brand transition-colors">
                        <i class="fas fa-briefcase text-2xl text-brand group-hover:text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-800">Career Support</h4>
                        <p class="text-gray-500 mt-1">CV building, interview prep, and freelancing roadmap.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section id="team" class="bg-gradient-to-br from-brand/5 via-white to-brand/5 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center animate-fadeInUp">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Meet Our Expert Team</h2>
            <p class="text-gray-500 mt-2 max-w-xl mx-auto">Passionate instructors and industry professionals ready to guide you.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
            <!-- Team Member 1 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden text-center animate-fadeInUp">
                <div class="relative h-48 bg-gradient-to-b from-brand/20 to-white">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-32 h-32 rounded-full mx-auto mt-12 border-4 border-white shadow-md object-cover">
                </div>
                <div class="p-5 pt-16">
                    <h5 class="text-xl font-bold text-gray-800">Rahim Ahmed</h5>
                    <p class="text-brand text-sm">Senior Web Developer</p>
                    <div class="flex justify-center gap-3 mt-3">
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden text-center animate-fadeInUp" style="animation-delay: 0.1s">
                <div class="relative h-48 bg-gradient-to-b from-brand/20 to-white">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" class="w-32 h-32 rounded-full mx-auto mt-12 border-4 border-white shadow-md object-cover">
                </div>
                <div class="p-5 pt-16">
                    <h5 class="text-xl font-bold text-gray-800">Karim Hasan</h5>
                    <p class="text-brand text-sm">Lead Graphic Designer</p>
                    <div class="flex justify-center gap-3 mt-3">
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-behance"></i></a>
                    </div>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden text-center animate-fadeInUp" style="animation-delay: 0.2s">
                <div class="relative h-48 bg-gradient-to-b from-brand/20 to-white">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" class="w-32 h-32 rounded-full mx-auto mt-12 border-4 border-white shadow-md object-cover">
                </div>
                <div class="p-5 pt-16">
                    <h5 class="text-xl font-bold text-gray-800">Nusrat Jahan</h5>
                    <p class="text-brand text-sm">Digital Marketing Expert</p>
                    <div class="flex justify-center gap-3 mt-3">
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <!-- Team Member 4 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden text-center animate-fadeInUp" style="animation-delay: 0.3s">
                <div class="relative h-48 bg-gradient-to-b from-brand/20 to-white">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" class="w-32 h-32 rounded-full mx-auto mt-12 border-4 border-white shadow-md object-cover">
                </div>
                <div class="p-5 pt-16">
                    <h5 class="text-xl font-bold text-gray-800">Sabbir Khan</h5>
                    <p class="text-brand text-sm">Lead Instructor (MERN)</p>
                    <div class="flex justify-center gap-3 mt-3">
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-brand transition"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section with Counter Animation -->
<section class="container mx-auto px-4 lg:px-8 py-16 lg:py-20">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow-md p-8 text-center transform hover:scale-105 transition duration-300 animate-fadeInUp">
            <i class="fas fa-user-graduate text-5xl text-brand mb-3"></i>
            <div class="text-4xl font-extrabold text-gray-800"><span class="counter" data-target="5000">0</span>+</div>
            <p class="text-gray-500 mt-1">Students Trained</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-8 text-center transform hover:scale-105 transition duration-300 animate-fadeInUp" style="animation-delay: 0.1s">
            <i class="fas fa-project-diagram text-5xl text-brand mb-3"></i>
            <div class="text-4xl font-extrabold text-gray-800"><span class="counter" data-target="10000">0</span>+</div>
            <p class="text-gray-500 mt-1">Projects Completed</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-8 text-center transform hover:scale-105 transition duration-300 animate-fadeInUp" style="animation-delay: 0.2s">
            <i class="fas fa-chart-line text-5xl text-brand mb-3"></i>
            <div class="text-4xl font-extrabold text-gray-800"><span class="counter" data-target="80">0</span>%</div>
            <p class="text-gray-500 mt-1">Success Rate</p>
        </div>
    </div>
</section>

<!-- Testimonials Section (Student Reviews) -->
<section class="bg-gradient-to-r from-brand/5 to-white py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center animate-fadeInUp">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">What Our Students Say</h2>
            <p class="text-gray-500 mt-2">Real experiences, real transformations</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8 mt-12">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300 animate-fadeInUp">
                <div class="flex items-center gap-3">
                    <img src="https://randomuser.me/api/portraits/men/15.jpg" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <h4 class="font-bold">Rakibul Islam</h4>
                        <div class="text-yellow-400 text-sm">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 text-gray-600 italic">“I started earning within 3 months after completing the web development course. The projects and mentorship were top-notch!”</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300 animate-fadeInUp" style="animation-delay: 0.1s">
                <div class="flex items-center gap-3">
                    <img src="https://randomuser.me/api/portraits/women/33.jpg" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <h4 class="font-bold">Shamima Akter</h4>
                        <div class="text-yellow-400 text-sm">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 text-gray-600 italic">“Best training center for beginners! The instructors are very supportive and the curriculum is up-to-date.”</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300 animate-fadeInUp" style="animation-delay: 0.2s">
                <div class="flex items-center gap-3">
                    <img src="https://randomuser.me/api/portraits/men/55.jpg" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <h4 class="font-bold">Masud Rana</h4>
                        <div class="text-yellow-400 text-sm">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 text-gray-600 italic">“Highly recommended for anyone serious about freelancing. The career support helped me land my first client.”</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="container mx-auto px-4 lg:px-8 py-16 lg:py-20 text-center">
    <div class="bg-gradient-to-r from-brand/20 via-white to-brand/20 rounded-3xl p-8 lg:p-12 shadow-xl animate-fadeInUp">
        <h3 class="text-3xl md:text-4xl font-bold text-gray-800">Start Your Career Today</h3>
        <p class="mt-2 text-gray-600 max-w-lg mx-auto">Join GenZ IT and build your future with in-demand digital skills.</p>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
            <a href="{{ route('courses') }}" class="inline-flex items-center gap-2 bg-brand text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                Explore Courses <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('admission') }}" class="inline-flex items-center gap-2 border border-brand text-brand px-6 py-3 rounded-lg hover:bg-brand hover:text-white transition-all duration-300">
                Apply Now <i class="fas fa-graduation-cap"></i>
            </a>
        </div>
    </div>
</section>

<!-- Custom CSS for Animations & Counter -->
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
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
    }
    .group:hover .group-hover\:bg-brand {
        transition: all 0.3s ease;
    }
</style>

<!-- Counter Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

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
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    });
</script>

<!-- FontAwesome (if not already in master layout) -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@endsection