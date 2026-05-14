@extends('templates.layouts.master')

@section('body')

<!-- HERO -->
<section class="bg-gradient-to-r from-red-50 to-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-4">

        <h1 class="text-4xl font-bold text-red-500">
            Admission Open
        </h1>

        <p class="mt-4 text-slate-600">
            Learn high-income skills & start earning in 3–6 months.
            Limited seats available.
        </p>

    </div>
</section>

<!-- MAIN -->
<section class="max-w-6xl mx-auto px-4 py-16 grid lg:grid-cols-2 gap-10">

    <!-- FORM -->
    <div class="bg-white shadow-xl rounded-xl p-8">

        <h2 class="text-2xl font-bold text-red-500 mb-6">
            Apply Now
        </h2>

        @if(session('success'))
            <div class="mb-5 p-4 rounded bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 p-4 rounded bg-red-100 text-red-600">
                <ul class="space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admission.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-5">

            @csrf

            <input type="text"
                name="name"
                value="{{ old('name', auth()->user()->name ?? '') }}"
                placeholder="Full Name *"
                required
                class="w-full border p-3 rounded">

            <input type="email"
                name="email"
                value="{{ old('email', auth()->user()->email ?? '') }}"
                placeholder="Email Address"
                class="w-full border p-3 rounded">

            <input type="text"
                name="phone"
                placeholder="Phone Number *"
                value="{{ old('phone') }}"
                required
                class="w-full border p-3 rounded">

            <!-- Course -->
            <select name="course_id"
                class="w-full border p-3 rounded"
                required>

                <option value="">
                    Select Course
                </option>

                @foreach($courses as $course)

                    <option value="{{ $course->id }}"
                        {{ old('course_id') == $course->id ? 'selected' : '' }}>

                        {{ $course->title }}
                        - ৳{{ number_format($course->price) }}

                    </option>

                @endforeach

            </select>

            <!-- Password if guest -->
            @guest

                <div>
                    <input type="password"
                        name="password"
                        placeholder="Create Password"
                        class="w-full border p-3 rounded">

                    <small class="text-slate-500">
                        Account will be created automatically.
                    </small>
                </div>

            @endguest

            <!-- Goal -->
            <textarea name="goal"
                placeholder="Your Goal / Why join?"
                class="w-full border p-3 rounded h-32">{{ old('goal') }}</textarea>

            <!-- Attachment -->
            <div>

                <label class="block mb-2 font-medium">
                    Payment Screenshot / Attachment
                </label>

                <input type="file"
                    name="attachment"
                    class="w-full border p-3 rounded">

                <small class="text-slate-500">
                    Upload payment screenshot or any document.
                </small>

            </div>

            <button class="w-full bg-red-500 text-white py-3 rounded font-semibold hover:bg-red-600 transition">
                Submit Application
            </button>

        </form>

    </div>

    <!-- INFO -->
    <div class="bg-red-50 p-8 rounded-xl">

        <h3 class="text-2xl font-bold text-red-500">
            Why Join GenZ IT?
        </h3>

        <ul class="mt-6 space-y-3 text-sm">

            <li>✔ Real Client Projects</li>

            <li>✔ Freelancing Roadmap</li>

            <li>✔ Job Support</li>

            <li>✔ Live + Recorded Classes</li>

            <li>✔ Certificate</li>

        </ul>

        <!-- Dynamic Courses -->
        <div class="mt-10">

            <h4 class="font-semibold text-lg mb-4">
                Available Courses
            </h4>

            <div class="space-y-4">

                @foreach($courses->take(5) as $course)

                    <div class="bg-white p-4 rounded-lg shadow-sm">

                        <div class="flex items-center justify-between">

                            <div>

                                <h5 class="font-semibold">
                                    {{ $course->title }}
                                </h5>

                                <p class="text-sm text-slate-500">
                                    {{ $course->duration }}
                                </p>

                            </div>

                            <div class="text-red-500 font-bold">
                                ৳{{ number_format($course->price) }}
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

        <!-- Help -->
        <div class="mt-8 p-4 bg-white rounded shadow text-center">

            <p class="text-sm">
                Need Help?
            </p>

            <a href="https://wa.me/8801603747235"
                target="_blank"
                class="text-red-500 font-semibold">

                Chat on WhatsApp

            </a>

        </div>

    </div>

</section>

@endsection