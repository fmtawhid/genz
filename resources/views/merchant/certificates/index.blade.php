@extends('merchant.layout.layout')

@section('content')

<main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">My Certificates</h2>
            <p class="text-gray-600 mt-1">Your certificates for approved courses</p>
        </div>

        @if(session('success'))
            <div class="mb-5 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($certificates as $certificate)
                @php $course = $certificate->course; @endphp

                @if($course)
                    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden border border-gray-200">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Certified
                                </span>
                                <span class="text-sm text-gray-500">{{ ucfirst($course->level) }}</span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-sm mb-5">
                                {{ \Illuminate\Support\Str::limit($course->description, 90) }}
                            </p>

                            <div class="space-y-2 text-sm text-gray-500 mb-5">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2 text-primary-600"></i>
                                    {{ $course->duration }}
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-check mr-2 text-primary-600"></i>
                                    Enrolled on {{ $certificate->created_at->format('d M Y') }}
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <a href="{{ route('merchant.certificates.show', $certificate->id) }}"
                                class="block text-center w-full px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-semibold transition">
                                    View Certificate
                                </a>
                                <a href="{{ route('merchant.certificates.download', $certificate->id) }}"
                                class="block text-center w-full px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-semibold transition">
                                    Download Certificate
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-span-full text-center py-20">
                    <i class="fas fa-certificate text-gray-300 text-6xl mb-5"></i>
                    <h3 class="text-2xl font-bold text-gray-700">No Certificates Yet</h3>
                    <p class="text-gray-500 mt-2">Certificates for approved courses will appear here.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $certificates->links() }}
        </div>
    </div>
</main>

@endsection
