@extends('templates.layouts.master')

@section('body')

<!-- Hero Section with Background Image -->
<section class="relative bg-cover bg-center bg-no-repeat"
         style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
    <div class="container mx-auto px-4 lg:px-8 py-20 lg:py-28 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white animate-fadeInDown">
            Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">Successful Students</span>
        </h1>
        <p class="mt-4 text-lg text-gray-200 max-w-2xl mx-auto animate-fadeInUp">
            Meet students who changed their lives with our courses – real stories, real success.
        </p>
        <div class="mt-8 animate-fadeInUp">
            <a href="#success-stories" class="inline-flex items-center gap-2 bg-brand hover:bg-brand/90 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                Explore Stories <i class="fas fa-arrow-down"></i>
            </a>
        </div>
    </div>
</section>

<!-- Success Stories Grid -->
<section id="success-stories" class="container mx-auto px-4 lg:px-8 py-16 lg:py-24">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Real People, Real Results</h2>
        <p class="text-gray-500 mt-2 max-w-xl mx-auto">Hear from our alumni who are now thriving in their careers</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Card 1 -->
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100 animate-fadeInUp">
            <div class="relative pt-8 pb-4 bg-gradient-to-b from-brand/5 to-white">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                     class="w-28 h-28 rounded-full mx-auto border-4 border-white shadow-lg object-cover">
                <div class="absolute top-4 right-4 bg-yellow-400 text-white rounded-full px-3 py-1 text-xs font-bold">
                    <i class="fas fa-star"></i> 5.0
                </div>
            </div>
            <div class="p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">Rifat Hasan</h3>
                <p class="text-brand font-semibold text-sm">Frontend Developer</p>
                <p class="text-gray-500 text-sm mt-1">Web Development Course (2024)</p>
                <div class="flex justify-center my-3 text-yellow-400">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 italic">“I got my first remote job within 3 months after completing this course. The projects and mentorship were top-notch!”</p>
                <button class="open-video mt-5 inline-flex items-center gap-2 bg-brand/10 text-brand px-5 py-2.5 rounded-xl font-medium hover:bg-brand hover:text-white transition-all duration-300"
                        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1">
                    <i class="fab fa-youtube"></i> Watch Success Story
                </button>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100 animate-fadeInUp" style="animation-delay: 0.1s">
            <div class="relative pt-8 pb-4 bg-gradient-to-b from-brand/5 to-white">
                <img src="https://randomuser.me/api/portraits/women/68.jpg" 
                     class="w-28 h-28 rounded-full mx-auto border-4 border-white shadow-lg object-cover">
                <div class="absolute top-4 right-4 bg-yellow-400 text-white rounded-full px-3 py-1 text-xs font-bold">
                    <i class="fas fa-star"></i> 5.0
                </div>
            </div>
            <div class="p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">Sadia Akter</h3>
                <p class="text-brand font-semibold text-sm">UI/UX Designer</p>
                <p class="text-gray-500 text-sm mt-1">UI/UX Design Course (2024)</p>
                <div class="flex justify-center my-3 text-yellow-400">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 italic">“Now I work with international clients from Upwork and Fiverr. The portfolio I built during the course was key.”</p>
                <button class="open-video mt-5 inline-flex items-center gap-2 bg-brand/10 text-brand px-5 py-2.5 rounded-xl font-medium hover:bg-brand hover:text-white transition-all duration-300"
                        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1">
                    <i class="fab fa-youtube"></i> Watch Success Story
                </button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100 animate-fadeInUp" style="animation-delay: 0.2s">
            <div class="relative pt-8 pb-4 bg-gradient-to-b from-brand/5 to-white">
                <img src="https://randomuser.me/api/portraits/men/45.jpg" 
                     class="w-28 h-28 rounded-full mx-auto border-4 border-white shadow-lg object-cover">
                <div class="absolute top-4 right-4 bg-yellow-400 text-white rounded-full px-3 py-1 text-xs font-bold">
                    <i class="fas fa-star"></i> 4.9
                </div>
            </div>
            <div class="p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">Tanvir Ahmed</h3>
                <p class="text-brand font-semibold text-sm">Digital Marketer</p>
                <p class="text-gray-500 text-sm mt-1">Digital Marketing Course (2023)</p>
                <div class="flex justify-center my-3 text-yellow-400">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text-gray-600 italic">“Freelancing income changed my life. I now run my own agency serving local businesses.”</p>
                <button class="open-video mt-5 inline-flex items-center gap-2 bg-brand/10 text-brand px-5 py-2.5 rounded-xl font-medium hover:bg-brand hover:text-white transition-all duration-300"
                        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1">
                    <i class="fab fa-youtube"></i> Watch Success Story
                </button>
            </div>
        </div>

        <!-- Add two more cards for better engagement -->
        <!-- Card 4 -->
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100 animate-fadeInUp" style="animation-delay: 0.3s">
            <div class="relative pt-8 pb-4 bg-gradient-to-b from-brand/5 to-white">
                <img src="https://randomuser.me/api/portraits/women/33.jpg" 
                     class="w-28 h-28 rounded-full mx-auto border-4 border-white shadow-lg object-cover">
                <div class="absolute top-4 right-4 bg-yellow-400 text-white rounded-full px-3 py-1 text-xs font-bold">
                    <i class="fas fa-star"></i> 5.0
                </div>
            </div>
            <div class="p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">Nusrat Jahan</h3>
                <p class="text-brand font-semibold text-sm">MERN Stack Developer</p>
                <p class="text-gray-500 text-sm mt-1">Full Stack Web Development</p>
                <div class="flex justify-center my-3 text-yellow-400">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 italic">“From zero coding to getting hired at a software company in just 6 months. Forever grateful!”</p>
                <button class="open-video mt-5 inline-flex items-center gap-2 bg-brand/10 text-brand px-5 py-2.5 rounded-xl font-medium hover:bg-brand hover:text-white transition-all duration-300"
                        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1">
                    <i class="fab fa-youtube"></i> Watch Success Story
                </button>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100 animate-fadeInUp" style="animation-delay: 0.4s">
            <div class="relative pt-8 pb-4 bg-gradient-to-b from-brand/5 to-white">
                <img src="https://randomuser.me/api/portraits/men/22.jpg" 
                     class="w-28 h-28 rounded-full mx-auto border-4 border-white shadow-lg object-cover">
                <div class="absolute top-4 right-4 bg-yellow-400 text-white rounded-full px-3 py-1 text-xs font-bold">
                    <i class="fas fa-star"></i> 4.8
                </div>
            </div>
            <div class="p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">Shahriar Islam</h3>
                <p class="text-brand font-semibold text-sm">Motion Graphics Artist</p>
                <p class="text-gray-500 text-sm mt-1">Motion Graphics & VFX</p>
                <div class="flex justify-center my-3 text-yellow-400">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 italic">“I'm now working as a freelancer on Fiverr and earning 3x what I used to. The course was incredibly practical.”</p>
                <button class="open-video mt-5 inline-flex items-center gap-2 bg-brand/10 text-brand px-5 py-2.5 rounded-xl font-medium hover:bg-brand hover:text-white transition-all duration-300"
                        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1">
                    <i class="fab fa-youtube"></i> Watch Success Story
                </button>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100 animate-fadeInUp" style="animation-delay: 0.5s">
            <div class="relative pt-8 pb-4 bg-gradient-to-b from-brand/5 to-white">
                <img src="https://randomuser.me/api/portraits/women/58.jpg" 
                     class="w-28 h-28 rounded-full mx-auto border-4 border-white shadow-lg object-cover">
                <div class="absolute top-4 right-4 bg-yellow-400 text-white rounded-full px-3 py-1 text-xs font-bold">
                    <i class="fas fa-star"></i> 5.0
                </div>
            </div>
            <div class="p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">Tahmina Begum</h3>
                <p class="text-brand font-semibold text-sm">SEO Specialist</p>
                <p class="text-gray-500 text-sm mt-1">Advanced SEO Course</p>
                <div class="flex justify-center my-3 text-yellow-400">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 italic">“Now I rank my own clients on Google first page. The strategies taught are gold.”</p>
                <button class="open-video mt-5 inline-flex items-center gap-2 bg-brand/10 text-brand px-5 py-2.5 rounded-xl font-medium hover:bg-brand hover:text-white transition-all duration-300"
                        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1">
                    <i class="fab fa-youtube"></i> Watch Success Story
                </button>
            </div>
        </div>
    </div>
</section>

<!-- YouTube Video Modal -->
<div id="videoModal" class="fixed inset-0 bg-black/80 flex items-center justify-center hidden z-50 transition-all duration-300">
    <div class="relative w-full max-w-4xl mx-4">
        <div class="relative bg-black rounded-2xl overflow-hidden shadow-2xl">
            <button id="closeModal" class="absolute top-3 right-4 text-white text-4xl z-10 hover:text-gray-300 transition">
                &times;
            </button>
            <div class="aspect-w-16 aspect-h-9">
                <iframe id="videoFrame" class="w-full h-full" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section (Enhanced) -->
<section class="bg-gradient-to-r from-brand/10 via-white to-brand/10 py-16 lg:py-20">
    <div class="container mx-auto px-4 lg:px-8 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Be our next success story</h2>
        <p class="text-gray-600 mt-2 max-w-xl mx-auto">Join thousands of students who transformed their careers with us.</p>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
            <a href="{{ route('courses') }}" class="inline-flex items-center gap-2 bg-brand text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                Explore Courses <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('admission') }}" class="inline-flex items-center gap-2 border border-brand text-brand px-6 py-3 rounded-lg hover:bg-brand hover:text-white transition-all duration-300">
                Apply Now <i class="fas fa-graduation-cap"></i>
            </a>
        </div>
    </div>
</section>

<!-- Custom CSS for Animations -->
<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
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
    .animate-fadeInDown {
        animation: fadeInDown 0.8s ease-out forwards;
    }
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }
    /* Aspect ratio helper for responsive iframe */
    .aspect-w-16 {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 */
    }
    .aspect-w-16 iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    /* Fallback using Tailwind's aspect-video? We'll keep simple */
    @supports (aspect-ratio: 16/9) {
        .aspect-w-16 {
            aspect-ratio: 16/9;
            padding-bottom: 0;
        }
        .aspect-w-16 iframe {
            position: static;
        }
    }
</style>

<!-- JavaScript for Modal & YouTube Autoplay -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('videoModal');
        const videoFrame = document.getElementById('videoFrame');
        const closeBtn = document.getElementById('closeModal');
        
        // Get all video buttons
        const videoButtons = document.querySelectorAll('.open-video');
        
        videoButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const videoUrl = this.getAttribute('data-video');
                if (videoUrl) {
                    // Ensure autoplay parameter is present for YouTube
                    let finalUrl = videoUrl;
                    if (videoUrl.includes('youtube.com/embed/') && !videoUrl.includes('autoplay=1')) {
                        finalUrl = videoUrl + (videoUrl.includes('?') ? '&autoplay=1' : '?autoplay=1');
                    }
                    videoFrame.src = finalUrl;
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            });
        });
        
        function closeModal() {
            modal.classList.add('hidden');
            videoFrame.src = ''; // Stop video
            document.body.style.overflow = '';
        }
        
        closeBtn.addEventListener('click', closeModal);
        
        // Close when clicking outside the video container
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    });
</script>

<!-- Ensure FontAwesome is loaded (if not already in master layout) -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@endsection