@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Contact Message</h2>
        <a href="{{ route('admin.contact-messages.index') }}" class="px-4 py-2 bg-gray-200 rounded">Back</a>
    </div>

    <div class="bg-white p-6 rounded shadow max-w-3xl space-y-5">
        <div class="grid md:grid-cols-2 gap-5">
            <div><h3 class="text-sm text-gray-500">Name</h3><p class="font-semibold">{{ $message->name }}</p></div>
            <div><h3 class="text-sm text-gray-500">Phone</h3><p class="font-semibold">{{ $message->phone }}</p></div>
            <div><h3 class="text-sm text-gray-500">Email</h3><p>{{ $message->email ?: '-' }}</p></div>
            <div><h3 class="text-sm text-gray-500">Received</h3><p>{{ $message->created_at->format('d M Y, h:i A') }}</p></div>
        </div>
        <div>
            <h3 class="text-sm text-gray-500 mb-1">Message</h3>
            <p class="whitespace-pre-line text-gray-700">{{ $message->message }}</p>
        </div>
        <form method="POST" action="{{ route('admin.contact-messages.destroy', $message->id) }}">
            @csrf
            @method('DELETE')
            <button class="px-4 py-2 bg-red-500 text-white rounded" onclick="return confirm('Delete this message?')">Delete Message</button>
        </form>
    </div>
</main>
@endsection
