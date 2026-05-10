@extends('admin.layout.layout')

@section('content')

<main class="flex-1 overflow-y-auto p-4 md:p-6">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-2xl font-bold">
                Student Details
            </h2>

            <p class="text-gray-500 text-sm">
                Full student information and enrolled courses
            </p>

        </div>

        <a href="{{ route('admin.merchant.list') }}"
           class="px-4 py-2 bg-gray-200 rounded">

            Back

        </a>

    </div>

    <!-- STUDENT INFO -->
    <div class="bg-white shadow rounded-xl p-6 mb-8">

        <div class="flex items-center gap-5">

            @if($merchant->logo)

                <img src="{{ asset('uploads/students/'.$merchant->logo) }}"
                     class="w-24 h-24 rounded-full object-cover border">

            @else

                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-3xl font-bold">
                    {{ strtoupper(substr($merchant->name, 0, 1)) }}
                </div>

            @endif

            <div>

                <h3 class="text-2xl font-bold">
                    {{ $merchant->name }}
                </h3>

                <p class="text-gray-500">
                    {{ $merchant->email }}
                </p>

                <p class="text-gray-500">
                    {{ $merchant->phone }}
                </p>

                <div class="mt-3 flex gap-2">

                    <span class="px-3 py-1 rounded text-sm
                        {{ $merchant->status == 'active'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700' }}">

                        {{ ucfirst($merchant->status) }}

                    </span>

                    <span class="px-3 py-1 rounded text-sm
                        {{ $merchant->verified
                            ? 'bg-blue-100 text-blue-700'
                            : 'bg-yellow-100 text-yellow-700' }}">

                        {{ $merchant->verified ? 'Verified' : 'Unverified' }}

                    </span>

                </div>

            </div>

        </div>

        @if($merchant->address)
            <div class="mt-6">

                <h4 class="font-semibold mb-2">
                    Address
                </h4>

                <p class="text-gray-600">
                    {{ $merchant->address }}
                </p>

            </div>
        @endif

    </div>

    <!-- COURSES -->
    <div class="bg-white shadow rounded-xl p-6">

        <div class="flex items-center justify-between mb-6">

            <h3 class="text-xl font-bold">
                Enrolled Courses
            </h3>

            <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded text-sm">

                {{ $merchant->admissions->count() }} Courses

            </span>

        </div>

        @if($merchant->admissions->count())

            <div class="space-y-5">

                @foreach($merchant->admissions as $admission)

                    <div class="border rounded-xl p-5">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                            <div>

                                <h4 class="text-lg font-semibold">

                                    {{ $admission->course->title ?? 'Course Deleted' }}

                                </h4>

                                <p class="text-sm text-gray-500 mt-1">

                                    Applied:
                                    {{ $admission->created_at->format('d M Y') }}

                                </p>

                            </div>

                            <div>

                                <span class="px-3 py-1 rounded text-sm
                                    @if($admission->status == 'approved')
                                        bg-green-100 text-green-700
                                    @elseif($admission->status == 'rejected')
                                        bg-red-100 text-red-700
                                    @else
                                        bg-yellow-100 text-yellow-700
                                    @endif">

                                    {{ ucfirst($admission->status) }}

                                </span>

                            </div>

                        </div>

                        <!-- Goal -->
                        @if($admission->goal)

                            <div class="mt-5">

                                <h5 class="font-semibold mb-2">
                                    Student Goal
                                </h5>

                                <div class="bg-gray-50 p-4 rounded text-gray-700">

                                    {{ $admission->goal }}

                                </div>

                            </div>

                        @endif

                        <!-- Attachment -->
                        @if($admission->attachment)

                            <div class="mt-5">

                                <h5 class="font-semibold mb-3">
                                    Payment Screenshot
                                </h5>

                                <a href="{{ asset('storage/'.$admission->attachment) }}"
                                   target="_blank">

                                    <img src="{{ asset('storage/'.$admission->attachment) }}"
                                         class="w-48 rounded border shadow">

                                </a>

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center py-12 text-gray-500">

                No courses enrolled yet

            </div>

        @endif

    </div>

</main>

@endsection