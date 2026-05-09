@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">

        <h2 class="text-xl font-semibold mb-4">Edit Student</h2>

        <form method="POST" action="{{ route('admin.merchant.update', $merchant->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4">

                {{-- Name --}}
                <div>
                    <label class="block text-gray-700">Name *</label>
                    <input type="text" name="name"
                           class="w-full border px-3 py-2 rounded"
                           value="{{ old('name', $merchant->name) }}" required>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-gray-700">Email *</label>
                    <input type="email" name="email"
                           class="w-full border px-3 py-2 rounded"
                           value="{{ old('email', $merchant->email) }}" required>
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-gray-700">Phone *</label>
                    <input type="text" name="phone"
                           class="w-full border px-3 py-2 rounded"
                           value="{{ old('phone', $merchant->phone) }}" required>
                </div>

                {{-- Address --}}
                <div>
                    <label class="block text-gray-700">Address</label>
                    <textarea name="address"
                              class="w-full border px-3 py-2 rounded">{{ old('address', $merchant->address) }}</textarea>
                </div>

                {{-- NID Number --}}
                <div>
                    <label class="block text-gray-700">NID Number</label>
                    <input type="text" name="nid_number"
                           class="w-full border px-3 py-2 rounded"
                           value="{{ old('nid_number', $merchant->nid_number) }}">
                </div>

                {{-- NID Front --}}
                <div>
                    <label class="block text-gray-700">NID Front</label>
                    <input type="file" name="nid_front" class="w-full">

                    @if($merchant->nid_front)
                        <img src="{{ asset('uploads/merchants/'.$merchant->nid_front) }}"
                             class="mt-2 w-32 rounded">
                    @endif
                </div>

                {{-- NID Back --}}
                <div>
                    <label class="block text-gray-700">NID Back</label>
                    <input type="file" name="nid_back" class="w-full">

                    @if($merchant->nid_back)
                        <img src="{{ asset('uploads/merchants/'.$merchant->nid_back) }}"
                             class="mt-2 w-32 rounded">
                    @endif
                </div>

                {{-- Logo --}}
                <div>
                    <label class="block text-gray-700">Profile Image</label>
                    <input type="file" name="logo" class="w-full">

                    @if($merchant->logo)
                        <img src="{{ asset('uploads/merchants/'.$merchant->logo) }}"
                             class="mt-2 w-32 rounded">
                    @endif
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-gray-700">Status *</label>
                    <select name="status" class="w-full border px-3 py-2 rounded" required>
                        <option value="active" {{ $merchant->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $merchant->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Verified --}}
                <div class="flex items-center">
                    <label class="flex items-center">
                        <input type="checkbox" name="verified" value="1"
                               {{ $merchant->verified ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Verified</span>
                    </label>
                </div>

                {{-- Button --}}
                <div>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
                        Update Student
                    </button>
                </div>

            </div>
        </form>
    </div>
</main>
@endsection