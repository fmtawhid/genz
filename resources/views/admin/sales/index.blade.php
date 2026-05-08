@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Sales</h1>
                <p class="text-gray-600 text-sm mt-1">Record and track sales transactions</p>
            </div>
            <a href="{{ route('admin.sales.create') }}" 
                class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium shadow-sm">
                + Record Sale
            </a>
        </div>

        <!-- Messages -->
        @if (session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4 flex items-center gap-3">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Sales Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Table Stats -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <p class="text-sm text-gray-600">Showing <strong>4</strong> of <strong>4</strong> sales</p>
            </div>

            <!-- Table -->
            @php
                $sales = collect([
                    (object)['product' => (object)['name' => 'Laptop Dell XPS'], 'merchant' => (object)['name' => 'Digital Store'], 'quantity' => 2, 'unit_price' => 55000, 'discount_value' => 5000, 'discount_type' => 'fixed', 'total_amount' => 105000, 'salesman' => (object)['name' => 'Ahmed Khan'], 'sale_date' => now(), 'id' => 1],
                    (object)['product' => (object)['name' => 'Wireless Mouse'], 'merchant' => (object)['name' => 'Tech Market'], 'quantity' => 5, 'unit_price' => 999, 'discount_value' => 10, 'discount_type' => 'percentage', 'total_amount' => 4495.5, 'salesman' => (object)['name' => 'Fatima Ahmed'], 'sale_date' => now()->subDays(1), 'id' => 2],
                    (object)['product' => (object)['name' => 'USB-C Cable'], 'merchant' => (object)['name' => 'Gadget Plus'], 'quantity' => 10, 'unit_price' => 249, 'discount_value' => 0, 'discount_type' => 'fixed', 'total_amount' => 2490, 'salesman' => (object)['name' => 'Hassan Ali'], 'sale_date' => now()->subDays(2), 'id' => 3],
                    (object)['product' => (object)['name' => '4K Monitor'], 'merchant' => (object)['name' => 'Digital Store'], 'quantity' => 1, 'unit_price' => 16000, 'discount_value' => 2000, 'discount_type' => 'fixed', 'total_amount' => 14000, 'salesman' => (object)['name' => 'Ahmed Khan'], 'sale_date' => now()->subDays(3), 'id' => 4],
                ]);
            @endphp
            @if($sales->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Product</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Merchant</th>
                                <th class="text-center py-4 px-6 font-semibold text-gray-700 text-sm">Qty</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Unit Price</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Discount</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Total</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Salesman</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Date</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($sales as $sale)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 px-6 text-sm font-semibold text-gray-900">{{ $sale->product->name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $sale->merchant->name }}</td>
                                    <td class="py-4 px-6 text-center text-sm text-gray-700">{{ $sale->quantity }}</td>
                                    <td class="py-4 px-6 text-right text-sm text-gray-700">৳{{ number_format($sale->unit_price, 2) }}</td>
                                    <td class="py-4 px-6 text-right text-sm">
                                        @if($sale->discount_value > 0)
                                            <span class="text-red-600 font-semibold">
                                                @if($sale->discount_type === 'percentage')
                                                    {{ $sale->discount_value }}%
                                                @else
                                                    ৳{{ number_format($sale->discount_value, 2) }}
                                                @endif
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="inline-block bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ৳{{ number_format($sale->total_amount, 2) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $sale->salesman->name ?? '-' }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $sale->sale_date->format('d-m-Y') }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.sales.show', $sale->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                            <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST" 
                                                onsubmit="return confirm('Delete this sale?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $sales->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Sales Yet</h3>
                    <p class="text-gray-600 mb-6">Record your first sale to get started</p>
                    <a href="{{ route('admin.sales.create') }}" class="inline-block px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium">
                        Record Sale
                    </a>
                </div>
            @endif
        </div>
    </main>
@endsection
