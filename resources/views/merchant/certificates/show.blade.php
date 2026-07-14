@extends('merchant.layout.layout')

@section('content')

<main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
    <div class="max-w-6xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('merchant.certificates.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Certificates
            </a>
            <a href="{{ route('merchant.certificates.download', $certificate->id) }}"
               class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold">
                <i class="fas fa-download mr-2"></i> Download PDF
            </a>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-4 shadow-xl md:p-6">
            <div class="overflow-hidden rounded-[28px] border border-emerald-900/20 bg-[#fffdfa] p-6 md:p-10" style="box-shadow: inset 0 0 0 1px rgba(11,93,56,0.08);">
                <div class="flex items-center justify-between border-b border-emerald-900/20 pb-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-emerald-800">Certificate of Achievement</p>
                        <h2 class="mt-2 text-2xl font-bold text-gray-900">GEN-Z IT INSTITUTE</h2>
                    </div>
                    <div class="rounded-full border border-emerald-800/20 bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-800">
                        Approved
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-sm italic text-gray-600">This is to certify that</p>
                    <h3 class="mt-3 text-3xl font-bold uppercase tracking-[0.25em] text-gray-900">{{ $certificate->name }}</h3>
                    <p class="mt-4 text-sm text-gray-600">has successfully completed the course</p>
                    <h4 class="mt-3 text-2xl font-semibold text-gray-900">{{ $certificate->course->title }}</h4>
                    <p class="mt-6 text-sm text-gray-600">Issued on {{ $certificate->updated_at->format('d M Y') }}</p>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-[1.2fr_0.8fr]">
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 text-sm text-gray-700">
                        <p class="font-semibold uppercase tracking-[0.2em] text-gray-500">Verification Link</p>
                        <a href="{{ $certificateUrl }}" target="_blank" rel="noopener" class="mt-2 block break-all text-primary-700 hover:text-primary-800 underline">
                            {{ $certificateUrl }}
                        </a>
                    </div>
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 text-sm text-gray-700">
                        <p class="font-semibold uppercase tracking-[0.2em] text-gray-500">Student Details</p>
                        <p class="mt-2"><span class="font-semibold text-gray-900">Email:</span> {{ $certificate->email }}</p>
                        <p class="mt-1"><span class="font-semibold text-gray-900">Course:</span> {{ $certificate->course->title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
