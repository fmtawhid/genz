@extends('admin.layout.layout')

@section('content')

<main class="flex-1 overflow-y-auto p-4 md:p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold">
                Admission Requests
            </h2>

            <p class="text-sm text-gray-500">
                Manage all student admission requests
            </p>
        </div>

    </div>

    @if(session('success'))
        <div class="mb-5 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">#</th>

                    <th class="p-4 text-left">Student</th>

                    <th class="p-4 text-left">Course</th>

                    <th class="p-4 text-left">Merchant</th>

                    <th class="p-4 text-left">Attachment</th>

                    <th class="p-4 text-left">Status</th>

                    <th class="p-4 text-left">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($admissions as $key => $admission)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4">
                            {{ $admissions->firstItem() + $key }}
                        </td>

                        <!-- Student -->
                        <td class="p-4">

                            <div>
                                <h4 class="font-semibold">
                                    {{ $admission->name }}
                                </h4>

                                <p class="text-sm text-gray-500">
                                    {{ $admission->phone }}
                                </p>

                                @if($admission->email)
                                    <p class="text-xs text-gray-400">
                                        {{ $admission->email }}
                                    </p>
                                @endif
                            </div>

                        </td>

                        <!-- Course -->
                        <td class="p-4">

                            @if($admission->course)

                                <div>

                                    <h4 class="font-medium">
                                        {{ $admission->course->title }}
                                    </h4>

                                    <p class="text-sm text-gray-500">
                                        ৳{{ number_format($admission->course->price) }}
                                    </p>

                                </div>

                            @endif

                        </td>

                        <!-- Merchant -->
                        <td class="p-4">

                            @if($admission->merchant)

                                <div>

                                    <h4 class="font-medium">
                                        {{ $admission->merchant->name }}
                                    </h4>

                                    <p class="text-sm text-gray-500">
                                        {{ $admission->merchant->phone }}
                                    </p>

                                </div>

                            @else

                                <span class="text-gray-400">
                                    Not Found
                                </span>

                            @endif

                        </td>

                        <!-- Attachment -->
                        <td class="p-4">

                            @if($admission->attachment)

                                <a href="{{ asset('storage/' . $admission->attachment) }}"
                                   target="_blank"
                                   class="text-blue-600 underline">

                                    View File

                                </a>

                            @else

                                <span class="text-gray-400">
                                    No File
                                </span>

                            @endif

                        </td>

                        <!-- Status -->
                        <td class="p-4">

                            <form method="POST"
                                  action="{{ route('admin.admissions.status', $admission->id) }}">

                                @csrf
                                @method('PUT')

                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="border rounded px-3 py-2 text-sm">

                                    <option value="pending"
                                        {{ $admission->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="approved"
                                        {{ $admission->status == 'approved' ? 'selected' : '' }}>
                                        Approved
                                    </option>

                                    <option value="rejected"
                                        {{ $admission->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>

                                </select>

                            </form>

                        </td>

                        <!-- Actions -->
                        <td class="p-4">

                            <div class="flex gap-2">

                                <a href="{{ route('admin.admissions.show', $admission->id) }}"
                                   class="px-3 py-2 bg-blue-500 text-white rounded text-sm">

                                    View

                                </a>

                                <form method="POST"
                                      action="{{ route('admin.admissions.destroy', $admission->id) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Delete this admission?')"
                                            class="px-3 py-2 bg-red-500 text-white rounded text-sm">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="p-8 text-center text-gray-500">

                            No admission requests found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- Pagination -->
    <div class="mt-6">

        {{ $admissions->links() }}

    </div>

</main>

@endsection