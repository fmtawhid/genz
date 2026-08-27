@extends('templates.layouts.master')
@section('body')


<!-- Hero -->
<section class="relative overflow-hidden bg-slate-950 py-20 text-center text-white">
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(239,68,68,0.28),_transparent_42%),radial-gradient(circle_at_bottom_left,_rgba(248,113,113,0.14),_transparent_38%)]"></div>
  <div class="relative container mx-auto px-4">
    <p class="text-red-300 font-semibold uppercase tracking-[0.2em] text-xs">Learn. Build. Grow.</p>
    <h1 class="mt-3 text-4xl sm:text-5xl font-extrabold tracking-tight">Build Skills That Move You Forward</h1>
    <p class="mt-4 text-slate-300 max-w-2xl mx-auto">
    Explore expert-led courses and grow your skills.
    </p>
    <div class="mt-8 flex flex-wrap justify-center gap-3 text-sm text-slate-300">
      <span class="rounded-full border border-white/15 bg-white/10 px-4 py-2"><i class="fas fa-laptop-code mr-2 text-red-300"></i>Practical learning</span>
      <span class="rounded-full border border-white/15 bg-white/10 px-4 py-2"><i class="fas fa-briefcase mr-2 text-red-300"></i>Career focused</span>
      <span class="rounded-full border border-white/15 bg-white/10 px-4 py-2"><i class="fas fa-certificate mr-2 text-red-300"></i>Expert guided</span>
    </div>
  </div>
</section>


<!-- Courses -->
<section class="container mx-auto px-4 py-16 lg:py-20">
  <form method="GET" action="{{ route('courses') }}" class="mb-10">
    <div class="max-w-3xl mx-auto rounded-2xl border border-red-100 bg-white p-2 shadow-lg shadow-red-900/5">
      <label for="search" class="sr-only">Search courses</label>
      <div class="relative">
        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <input id="search" type="search" name="search" value="{{ request('search') }}" placeholder="Search by title or topic..."
               class="w-full rounded-xl border-0 bg-slate-50 pl-11 pr-28 py-4 focus:bg-white focus:ring-2 focus:ring-brand/30">
        <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-brand text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-brand-600 transition">
          Search
        </button>
      </div>
    </div>

    <div class="mt-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
      <aside class="lg:col-span-4 lg:sticky lg:top-24 self-start bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
        <div class="flex items-center gap-2 mb-5">
          <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand/10 text-brand"><i class="fas fa-sliders"></i></div>
          <div>
            <h2 class="text-xl font-bold text-slate-800">Filter Courses</h2>
            <p class="text-xs text-slate-500">Find the right fit for you</p>
          </div>
        </div>

        <div class="space-y-4">
          <div>
            <label for="level" class="block text-sm font-semibold text-slate-700 mb-2">Level</label>
            <select id="level" name="level" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:border-brand focus:ring-brand">
              <option value="">All levels</option>
              @foreach($levels as $level)
                <option value="{{ $level }}" @selected(request('level') === $level)>{{ ucfirst($level) }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label for="sort" class="block text-sm font-semibold text-slate-700 mb-2">Sort by</label>
            <select id="sort" name="sort" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:border-brand focus:ring-brand">
              <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
              <option value="title" @selected(request('sort') === 'title')>Title A-Z</option>
              <option value="price_low" @selected(request('sort') === 'price_low')>Price: Low to high</option>
              <option value="price_high" @selected(request('sort') === 'price_high')>Price: High to low</option>
            </select>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label for="min_price" class="block text-sm font-semibold text-slate-700 mb-2">Min price</label>
              <input id="min_price" type="number" name="min_price" min="0" value="{{ request('min_price') }}" placeholder="৳ 0"
                     class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:border-brand focus:ring-brand">
            </div>
            <div>
              <label for="max_price" class="block text-sm font-semibold text-slate-700 mb-2">Max price</label>
              <input id="max_price" type="number" name="max_price" min="0" value="{{ request('max_price') }}" placeholder="৳ 5000"
                     class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:border-brand focus:ring-brand">
            </div>
          </div>

          <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-brand text-white px-4 py-2.5 rounded-lg font-semibold hover:bg-brand-600 transition">
            <i class="fas fa-filter"></i>
            Apply Filters
          </button>
          <a href="{{ route('courses') }}" class="w-full inline-flex items-center justify-center gap-2 border border-brand text-brand px-4 py-2.5 rounded-lg font-semibold hover:bg-brand hover:text-white transition">
            <i class="fas fa-rotate-left"></i>
            Clear Filters
          </a>
        </div>
      </aside>

      <div class="lg:col-span-8">
        <div class="flex flex-wrap items-end justify-between gap-3 mb-6">
          <div>
            <p class="text-sm font-semibold text-brand uppercase tracking-wide">Course library</p>
            <h2 class="mt-1 text-2xl font-bold text-slate-900">Available courses</h2>
          </div>
          <p class="text-sm text-slate-500">Showing {{ $courses->firstItem() ?? 0 }}-{{ $courses->lastItem() ?? 0 }} of {{ $courses->total() }} courses</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($courses as $course)
    <!-- Dynamic Course Card -->
    <div class="group flex h-full flex-col bg-white shadow-sm rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200">
      <div class="relative overflow-hidden h-48 bg-slate-100">
        <img src="{{ $course->thumbnail ? asset($course->thumbnail) : 'https://placehold.co/400x250?text=' . urlencode($course->title) }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        <span class="absolute top-4 left-4 bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">{{ $course->level ?? 'All Levels' }}</span>
      </div>
      <div class="flex flex-1 flex-col p-5">
        <h3 class="font-bold text-xl leading-snug text-slate-800">{{ $course->title }}</h3>
        <p class="text-sm text-slate-500 mt-1"><i class="far fa-clock mr-1"></i>{{ $course->duration ?? 'N/A' }} Hours</p>
        <p class="mt-2 text-slate-600 line-clamp-2">{{ $course->description ?? 'Professional course content' }}</p>
        <div class="mt-2 flex items-center gap-2">
          <span class="text-xs font-medium bg-brand/10 text-brand px-2 py-1 rounded">{{ $course->lessons->count() }} Lessons</span>
          <span class="text-xs font-medium bg-amber-100 text-amber-800 px-2 py-1 rounded">{{ $course->level ?? 'All Level' }}</span>
        </div>
        <div class="mt-auto pt-5 flex justify-between items-center">
          <span class="text-xl font-bold text-slate-800">৳{{ number_format($course->price ?? 0) }}</span>
          <a href="{{ route('course.details', $course->slug) }}" class="bg-brand text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-brand-600 transition">Details</a>
        </div>
      </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
      <p class="text-slate-600 text-lg">No courses match your filters.</p>
    </div>
    @endforelse

        </div>

        <!-- Pagination -->
        @if($courses->hasPages())
        <div class="mt-12 flex justify-center">
          {{ $courses->onEachSide(1)->links() }}
        </div>
        @endif
      </div>
    </div>
</form>

</section>


<!-- CTA -->
<section class="relative overflow-hidden bg-brand py-16 text-center text-white">
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_15%_20%,_rgba(255,255,255,0.14),_transparent_30%),radial-gradient(circle_at_85%_80%,_rgba(127,29,29,0.35),_transparent_36%)]"></div>
  <div class="relative container mx-auto px-4">
    <p class="text-red-100 text-sm font-semibold uppercase tracking-[0.2em]">Your next chapter starts here</p>
    <h3 class="mt-3 text-3xl font-bold">Start Learning Today</h3>
    <p class="mt-2 text-red-100 max-w-xl mx-auto">Choose a course, build real skills, and take the next step in your career.</p>
    <a href="{{ route('admission') }}" class="mt-6 inline-flex items-center gap-2 bg-white text-brand px-6 py-3 rounded-lg font-semibold hover:bg-red-50 transition shadow-lg">
    Admission Now
      <i class="fas fa-arrow-right"></i>
    </a>
  </div>
</section>

@endsection