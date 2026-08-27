@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <h2 class="text-2xl font-bold mb-4">Create Review</h2>

    @if($errors->any())
        <div class="p-3 mb-4 bg-red-100 text-red-700 rounded"><ul class="list-disc ml-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form method="POST" action="{{ route('admin.reviews.store') }}" class="bg-white p-6 rounded shadow max-w-3xl space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Profession</label>
            <input type="text" name="profession" value="{{ old('profession') }}" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Message</label>
            <textarea name="message" rows="5" class="w-full p-2 border rounded" required>{{ old('message') }}</textarea>
        </div>
        <div>
            <label for="rating" class="block text-sm font-semibold mb-1">Rating</label>
            <select id="rating" name="rating" class="w-full p-2 border rounded" required>
                @for($rating = 5; $rating >= 1; $rating--)
                    <option value="{{ $rating }}" @selected(old('rating', 5) == $rating)>{{ $rating }} / 5</option>
                @endfor
            </select>
        </div>
        <button class="px-4 py-2 bg-primary-700 text-white rounded">Save Review</button>
    </form>
</main>
@endsection
