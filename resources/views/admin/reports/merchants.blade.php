@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Merchants Report</h1>
            <p class="text-gray-600 text-sm mt-1">View merchant sales performance and metrics</p>
        </div>

        <!-- Summary Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-6">
            @php
                $merchants = collect([
                    (object)[
                        'id' => 1,
                        'name' => 'Digital Store',
                        'email' => 'digital@store.com',
                        'phone' => '01700123456',
                        'total_purchases' => 12,
                        'total_spent' => 195000,
                    ],
                    (object)[
                        'id' => 2,
                        'name' => 'Tech Market',
                        'email' => 'tech@market.com',
                        'phone' => '01800234567',
                        'total_purchases' => 8,
                        'total_spent' => 125000,
                    ],
                    (object)[
                        'id' => 3,
                        'name' => 'Gadget Plus',
                        'email' => 'gadget@plus.com',
                        'phone' => '01900345678',
                        'total_purchases' => 15,
                        'total_spent' => 188000,
                    ],
                ]);
            @endphp
            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-gray-600 text-sm font-medium mb-2">Total Merchants</p>
                <p class="text-4xl font-bold text-blue-600">{{ $merchants->count() }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-gray-600 text-sm font-medium mb-2">Total Sales Revenue</p>
                <p class="text-4xl font-bold text-green-600">৳{{ number_format($merchants->sum('total_spent'), 2) }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-gray-600 text-sm font-medium mb-2">Total Transactions</p>
                <p class="text-4xl font-bold text-purple-600">{{ $merchants->sum('total_purchases') }}</p>
            </div>
        </div>

        <!-- Merchants Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <p class="text-sm text-gray-600">Showing <strong>{{ $merchants->count() }}</strong> merchants</p>
            </div>

            @if($merchants->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Merchant Name</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Contact</th>
                                <th class="text-center py-4 px-6 font-semibold text-gray-700 text-sm">Total Purchases</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Total Spent</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Avg per Purchase</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($merchants as $merchant)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6 text-sm font-semibold text-gray-900">{{ $merchant->name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-700">
                                        <div>{{ $merchant->email ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $merchant->phone ?? '-' }}</div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $merchant->total_purchases }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            ৳{{ number_format($merchant->total_spent, 2) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right text-sm text-gray-700">
                                        ৳{{ number_format($merchant->total_purchases > 0 ? $merchant->total_spent / $merchant->total_purchases : 0, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No merchants found.</p>
                </div>
            @endif
        </div>
    </main>
@endsection
