@extends('templates.layouts.master')

@section('body')

<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-no-repeat"
    style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=2070&q=80');">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-28 text-center">

        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
            Success Story Video
        </h1>

        <p class="mt-4 text-gray-200 max-w-2xl mx-auto text-sm sm:text-base">
            Watch how our students transformed their careers.
        </p>

    </div>
</section>

@php
$videos = [
    "https://www.youtube.com/embed/dQw4w9WgXcQ",
    "https://www.youtube.com/embed/dQw4w9WgXcQ",
    "https://www.youtube.com/embed/dQw4w9WgXcQ",
    "https://www.youtube.com/embed/dQw4w9WgXcQ",
    "https://www.youtube.com/embed/dQw4w9WgXcQ",
    "https://www.youtube.com/embed/dQw4w9WgXcQ",
];
@endphp

<!-- Video Grid -->
<section class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">

        @foreach($videos as $video)
            <div class="rounded-xl sm:rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 bg-black">

                <div class="aspect-video">
                    <iframe
                        class="w-full h-full"
                        src="{{ $video }}?autoplay=0"
                        title="YouTube video"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>
        @endforeach

    </div>

</section>

@endsection