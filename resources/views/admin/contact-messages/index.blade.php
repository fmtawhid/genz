@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Contact Messages</h2>
            <p class="text-sm text-gray-500 mt-1">Messages submitted from the contact form.</p>
        </div>
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
                    <th class="p-3 text-left">Phone</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Message</th>
                    <th class="p-3 text-left">Received</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $key => $message)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $messages->firstItem() + $key }}</td>
                        <td class="p-3 font-semibold">{{ $message->name }}</td>
                        <td class="p-3">{{ $message->phone }}</td>
                        <td class="p-3">{{ $message->email ?: '-' }}</td>
                        <td class="p-3 max-w-sm">{{ Str::limit($message->message, 80) }}</td>
                        <td class="p-3 text-sm text-gray-500">{{ $message->created_at->format('d M Y, h:i A') }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="px-3 py-1 bg-primary-700 text-white rounded">View</a>
                            <form method="POST" action="{{ route('admin.contact-messages.destroy', $message->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-500 text-white rounded" onclick="return confirm('Delete this message?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-6 text-center text-gray-500">No contact messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $messages->links() }}</div>
</main>
@endsection
