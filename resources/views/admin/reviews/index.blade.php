@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Reviews</h2>
        <a href="{{ route('admin.reviews.create') }}" class="px-4 py-2 bg-primary-700 text-white rounded">+ Add Review</a>
    </div>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full">
            <thead class="bg-primary-50">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Profession</th>
                    <th class="p-3 text-left">Message</th>
                    <th class="p-3 text-left">Rating</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $key => $review)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $reviews->firstItem() + $key }}</td>
                        <td class="p-3 font-semibold">{{ $review->name }}</td>
                        <td class="p-3">{{ $review->profession }}</td>
                        <td class="p-3 max-w-md">{{ Str::limit($review->message, 90) }}</td>
                        <td class="p-3 text-amber-500 whitespace-nowrap">{{ str_repeat('★', $review->rating) }}<span class="text-gray-300">{{ str_repeat('★', 5 - $review->rating) }}</span></td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded">Edit</a>
                            <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-500 text-white rounded" onclick="return confirm('Delete this review?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-gray-500">No reviews found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $reviews->links() }}</div>
</main>
@endsection
