@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Suppliers</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <table class="w-full">
                <thead class="border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Name</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Email</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Phone</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">ABC Suppliers</td>
                        <td class="py-3 px-4">supplier@example.com</td>
                        <td class="py-3 px-4">+1234567890</td>
                        <td class="py-3 px-4">
                            <button class="text-blue-600 hover:text-blue-800 mr-4">Edit</button>
                            <button class="text-red-600 hover:text-red-800">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
