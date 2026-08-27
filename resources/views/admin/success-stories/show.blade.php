@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Success Story Details</h2>
        <a href="{{ route('admin.success-stories.index') }}" class="px-4 py-2 bg-gray-200 rounded">Back</a>
    </div>

    <div class="bg-white p-6 rounded shadow max-w-3xl space-y-5">
        <div><h3 class="text-sm text-gray-500">Title</h3><p class="text-xl font-semibold">{{ $successStory->title }}</p></div>
        <div><h3 class="text-sm text-gray-500">YouTube URL</h3><a href="{{ $successStory->youtube_url }}" target="_blank" rel="noopener" class="text-blue-600 underline break-all">{{ $successStory->youtube_url }}</a></div>
        <div><h3 class="text-sm text-gray-500">Note</h3><p class="whitespace-pre-line">{{ $successStory->note ?: 'No note added.' }}</p></div>
        <a href="{{ route('admin.success-stories.edit', $successStory->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded">Edit</a>
    </div>
</main>
@endsection
