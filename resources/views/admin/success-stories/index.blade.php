@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Success Stories</h2>
        <a href="{{ route('admin.success-stories.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">+ Add Success Story</a>
    </div>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">YouTube URL</th>
                    <th class="p-3 text-left">Note</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($successStories as $key => $successStory)
                    <tr class="border-b">
                        <td class="p-3">{{ $successStories->firstItem() + $key }}</td>
                        <td class="p-3 font-semibold">{{ $successStory->title }}</td>
                        <td class="p-3 max-w-xs truncate"><a class="text-blue-600 underline" href="{{ $successStory->youtube_url }}" target="_blank" rel="noopener">{{ $successStory->youtube_url }}</a></td>
                        <td class="p-3">{{ Str::limit($successStory->note, 80) }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.success-stories.show', $successStory->id) }}" class="px-3 py-1 bg-green-500 text-white rounded">Details</a>
                            <a href="{{ route('admin.success-stories.edit', $successStory->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded">Edit</a>
                            <form method="POST" action="{{ route('admin.success-stories.destroy', $successStory->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-500 text-white rounded" onclick="return confirm('Delete this success story?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-gray-500">No success stories found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $successStories->links() }}</div>
</main>
@endsection
