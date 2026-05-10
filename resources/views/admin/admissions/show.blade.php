@extends('admin.layout.layout')

@section('content')

<main class="flex-1 overflow-y-auto p-6">

    <div class="bg-white rounded-xl shadow p-8">

        <div class="flex items-center justify-between mb-8">

            <h2 class="text-2xl font-bold">
                Admission Details
            </h2>

            <a href="{{ route('admin.admissions.index') }}"
               class="px-4 py-2 bg-gray-200 rounded">

                Back

            </a>

        </div>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="space-y-5">

                <div>
                    <label class="font-semibold">
                        Student Name
                    </label>

                    <p class="text-gray-600">
                        {{ $admission->name }}
                    </p>
                </div>

                <div>
                    <label class="font-semibold">
                        Email
                    </label>

                    <p class="text-gray-600">
                        {{ $admission->email }}
                    </p>
                </div>

                <div>
                    <label class="font-semibold">
                        Phone
                    </label>

                    <p class="text-gray-600">
                        {{ $admission->phone }}
                    </p>
                </div>

                <div>
                    <label class="font-semibold">
                        Course
                    </label>

                    <p class="text-gray-600">
                        {{ $admission->course->title ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <label class="font-semibold">
                        Status
                    </label>

                    <p class="text-gray-600 capitalize">
                        {{ $admission->status }}
                    </p>
                </div>

            </div>

            <div class="space-y-5">

                <div>
                    <label class="font-semibold">
                        Merchant
                    </label>

                    <p class="text-gray-600">
                        {{ $admission->merchant->name ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <label class="font-semibold">
                        Goal
                    </label>

                    <div class="mt-2 p-4 bg-gray-50 rounded">

                        {{ $admission->goal }}

                    </div>
                </div>

                @if($admission->attachment)

                    <div>

                        <label class="font-semibold block mb-3">
                            Payment Screenshot
                        </label>

                        <img src="{{ asset('storage/' . $admission->attachment) }}"
                             class="w-full rounded shadow">

                    </div>

                @endif

            </div>

        </div>

    </div>

</main>

@endsection