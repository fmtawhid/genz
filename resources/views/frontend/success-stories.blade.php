{{-- resources/views/frontend/success-stories.blade.php --}}
@extends('layouts.master')

@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-brand/10 to-white py-20 text-center">
  <div class="container mx-auto px-4">
    <h1 class="text-4xl md:text-5xl font-extrabold text-brand">Our Successful Students</h1>
    <p class="text-slate-600 mt-3 max-w-2xl mx-auto">
      Meet some of our amazing students who transformed their careers through our training programs.
    </p>
  </div>
</section>

<!-- Success Stories Grid -->
<section class="container mx-auto px-4 py-16">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
    @forelse($reviews as $review)
      @php
        $photoUrl = method_exists($review, 'getPhotoUrlAttribute')
          ? $review->photo_url
          : (
              ($review->image && file_exists(public_path('img/reviews/'.$review->image)))
                ? asset('img/reviews/'.$review->image)
                : 'https://via.placeholder.com/100x100.png?text=Student'
            );
      @endphp

      <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 text-center">
        <img src="{{ $photoUrl }}" alt="{{ $review->student_name }}" class="w-28 h-28 mx-auto rounded-full object-cover shadow">
        <h3 class="font-semibold text-lg mt-4">{{ $review->student_name }}</h3>

        @if($review->position_name)
          <p class="text-brand text-sm font-medium">{{ $review->position_name }}</p>
        @endif

        <p class="text-slate-500 text-sm mt-1">
          {{ $review->course?->title }}
        </p>

        @if($review->body)
          <p class="text-slate-600 text-sm mt-3">“{{ $review->body }}”</p>
        @endif

        @if($review->video_url)
          <button
            type="button"
            class="open-video mt-4 inline-block bg-brand text-white px-4 py-2 rounded-md hover:bg-brand/90 transition"
            data-video="{{ $review->video_url }}">
            ▶ Watch Video
          </button>
        @endif
      </div>
    @empty
      <div class="col-span-3 text-center text-slate-600">
        No success stories yet.
      </div>
    @endforelse
  </div>
</section>

<!-- Video Modal (uses inline style instead of Tailwind `hidden`) -->
<div id="videoModal"
     class="fixed inset-0 bg-black/70 items-center justify-center z-50"
     style="display:none;">
  <div class="relative w-full max-w-3xl aspect-video bg-black rounded-lg overflow-hidden mx-4">
    <iframe
      id="videoFrame"
      class="w-full h-full"
      src=""
      frameborder="0"
      allow="autoplay; fullscreen; encrypted-media"
      allowfullscreen>
    </iframe>
    <button id="closeModal"
            class="absolute top-2 right-2 text-white text-3xl font-bold leading-none"
            aria-label="Close video">&times;
    </button>
  </div>
</div>

<!-- CTA Section -->
<section class="bg-brand text-white py-16 text-center rounded-t-[3rem]">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold">Want to be our next success story?</h2>
    <p class="text-white/80 mt-3 max-w-2xl mx-auto">
      Join our hands-on learning programs and start your career transformation today.
    </p>
    <a href="{{ route('course') }}" class="mt-6 inline-block bg-white text-brand px-6 py-3 rounded-md font-semibold shadow hover:bg-slate-100 transition">
      Explore Courses
    </a>
  </div>
</section>

@endsection

{{-- If your layout includes @yield('scripts'), put this in @section('scripts'). 
   If not, temporarily move the <script> block right above @endsection of content. --}}
@section('scripts')
<script>
(function () {
  function log(...args){ try { console.log('[SuccessStories]', ...args); } catch(e){} }
  function error(...args){ try { console.error('[SuccessStories]', ...args); } catch(e){} }

  const modal = document.getElementById('videoModal');
  const frame = document.getElementById('videoFrame');
  const closeBtn = document.getElementById('closeModal');

  if (!modal || !frame || !closeBtn) {
    error('Modal elements missing. Check IDs: videoModal, videoFrame, closeModal');
    return;
  }

  // Event delegation: any .open-video button click
  document.addEventListener('click', function(e) {
    const btn = e.target.closest('.open-video');
    if (!btn) return;

    e.preventDefault();

    const url = btn.getAttribute('data-video') || '';
    if (!url) { error('No data-video found on button'); return; }

    const embedUrl = toEmbedUrl(url);
    if (!embedUrl) { error('Could not parse/embed URL:', url); return; }

    // add autoplay safely
    frame.src = embedUrl + (embedUrl.includes('?') ? '&' : '?') + 'autoplay=1';

    // show modal (no Tailwind dependency)
    modal.style.display = 'flex';
  });

  function closeModal() {
    frame.src = '';               // stop video
    modal.style.display = 'none'; // hide
  }

  closeBtn.addEventListener('click', function(e){ e.preventDefault(); closeModal(); });

  // click on backdrop closes
  modal.addEventListener('click', function(e){
    if (e.target === modal) closeModal();
  });

  // Escape key closes
  document.addEventListener('keydown', function(e){
    if (e.key === 'Escape' && modal.style.display !== 'none') closeModal();
  });

  function toEmbedUrl(raw) {
    try {
      const u = new URL(raw);

      // youtube watch
      if (u.hostname.includes('youtube.com') && u.pathname === '/watch') {
        const v = u.searchParams.get('v');
        const t = u.searchParams.get('t');
        if (!v) return null;
        let embed = `https://www.youtube.com/embed/${v}`;
        const start = parseTimeToSeconds(t);
        if (start) embed += `?start=${start}`;
        return embed;
      }

      // youtu.be short
      if (u.hostname.includes('youtu.be')) {
        const id = u.pathname.replace('/', '');
        const t = u.searchParams.get('t');
        if (!id) return null;
        let embed = `https://www.youtube.com/embed/${id}`;
        const start = parseTimeToSeconds(t);
        if (start) embed += `?start=${start}`;
        return embed;
      }

      // already embed or other providers
      return raw;
    } catch (e) {
      error('URL parse error', e);
      return null;
    }
  }

  // supports '90' or '1m30s' or '1h2m3s'
  function parseTimeToSeconds(t) {
    if (!t) return 0;
    if (/^\d+$/.test(t)) return parseInt(t, 10);
    const m = /(?:(\d+)h)?(?:(\d+)m)?(?:(\d+)s)?/.exec(t);
    if (!m) return 0;
    const h = parseInt(m[1] || '0', 10);
    const mi = parseInt(m[2] || '0', 10);
    const s = parseInt(m[3] || '0', 10);
    return h*3600 + mi*60 + s;
  }
})();
</script>
@endsection
