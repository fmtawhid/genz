@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Success Story</h2>

    @if($errors->any())
        <div class="p-3 mb-4 bg-red-100 text-red-700 rounded"><ul class="list-disc ml-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form method="POST" action="{{ route('admin.success-stories.update', $successStory->id) }}" class="bg-white p-6 rounded shadow max-w-3xl">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ old('title', $successStory->title) }}" placeholder="Title" class="w-full p-2 border mb-3" required>
        <input type="url" name="youtube_url" value="{{ old('youtube_url', $successStory->youtube_url) }}" placeholder="YouTube URL" class="w-full p-2 border mb-3" required>
        <textarea name="note" placeholder="Note" rows="6" class="w-full p-2 border mb-3">{{ old('note', $successStory->note) }}</textarea>
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Update Success Story</button>
    </form>
</main>
@endsection
