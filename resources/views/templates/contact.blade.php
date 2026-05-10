@extends('templates.layouts.master')

@section('body')

<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-no-repeat"
         style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
    <div class="container mx-auto px-4 lg:px-8 py-20 lg:py-28 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white animate-fadeInDown">
            Contact <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">Us</span>
        </h1>
        <p class="mt-4 text-lg text-gray-200 max-w-2xl mx-auto animate-fadeInUp">
            Have questions? We're here to help. Reach out anytime.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="container mx-auto px-4 lg:px-8 py-16 lg:py-24">
    <div class="grid lg:grid-cols-3 gap-12">
        
        <!-- Contact Info Cards -->
        <div class="space-y-6 animate-fadeInUp">
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center group-hover:bg-primary-700 transition">
                        <i class="fas fa-phone-alt text-xl text-primary-700 group-hover:text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Phone</h4>
                        <p class="text-gray-500 text-sm">+880 1712 345678</p>
                        <p class="text-gray-500 text-sm">+880 1987 654321</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center group-hover:bg-primary-700 transition">
                        <i class="fas fa-envelope text-xl text-primary-700 group-hover:text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Email</h4>
                        <p class="text-gray-500 text-sm">info@genzit.com</p>
                        <p class="text-gray-500 text-sm">support@genzit.com</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center group-hover:bg-primary-700 transition">
                        <i class="fas fa-map-marker-alt text-xl text-primary-700 group-hover:text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Address</h4>
                        <p class="text-gray-500 text-sm">House #123, Road #45,</p>
                        <p class="text-gray-500 text-sm">Uttara, Dhaka - 1230, Bangladesh</p>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Card -->
            <div class="bg-gradient-to-r from-primary-50 to-white p-6 rounded-2xl shadow-md text-center border border-primary-100">
                <i class="fab fa-whatsapp text-4xl text-green-500 mb-2"></i>
                <h4 class="font-bold text-gray-800">Need instant reply?</h4>
                <p class="text-gray-500 text-sm mt-1">Chat with us on WhatsApp</p>
                <a href="https://wa.me/8801712345678" target="_blank" 
                   class="mt-3 inline-flex items-center gap-2 bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition">
                    <i class="fab fa-whatsapp"></i> Start Chat
                </a>
            </div>

            <!-- Social Links -->
            <div class="bg-white p-6 rounded-2xl shadow-md text-center">
                <h4 class="font-bold text-gray-800 mb-3">Follow Us</h4>
                <div class="flex justify-center gap-4">
                    <a href="#" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 hover:bg-primary-700 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 hover:bg-primary-700 hover:text-white transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 hover:bg-primary-700 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 hover:bg-primary-700 hover:text-white transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-8 animate-fadeInUp" style="animation-delay: 0.1s">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Send us a Message</h2>
            <p class="text-gray-500 mb-6">We'll get back to you within 24 hours.</p>
            
            <form action="#" method="POST" class="space-y-5">
                @csrf
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                        <input type="text" name="name" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-primary-700 focus:border-primary-700 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                        <input type="tel" name="phone" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-primary-700 focus:border-primary-700 transition">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                    <input type="email" name="email" required 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-primary-700 focus:border-primary-700 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <input type="text" name="subject" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-primary-700 focus:border-primary-700 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Your Message *</label>
                    <textarea name="message" rows="5" required 
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-primary-700 focus:border-primary-700 transition"></textarea>
                </div>
                <button type="submit" 
                        class="w-full bg-primary-700 text-white py-3 rounded-lg font-semibold hover:bg-primary-800 transition shadow-md">
                    Send Message <i class="fas fa-paper-plane ml-2"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Google Map Section -->
<section class="container mx-auto px-4 lg:px-8 pb-16 lg:pb-24">
    <div class="bg-white rounded-2xl shadow-md overflow-hidden animate-fadeInUp" style="animation-delay: 0.2s">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.902!2d90.3899!3d23.7738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7e1c9c0c0c1%3A0x9e6c0c0c0c0c0c0!2sUttara%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd" 
            width="100%" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-primary-700 py-16 lg:py-20 text-center">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Still Confused About Your Career?</h2>
        <p class="mt-2 text-primary-100 max-w-lg mx-auto">Join our free seminar & get clear direction from industry experts.</p>
        <div class="mt-6">
            <a href="#" class="inline-flex items-center gap-2 bg-white text-primary-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                Join Free Seminar <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Animations CSS -->
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
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
    }
    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
    }
</style>

<!-- FontAwesome (if not already in master layout) -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@endsection