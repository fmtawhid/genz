@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        @php
            // Dummy sale data
            $sale = (object)[
                'id' => 1,
                'product' => (object)['name' => 'Laptop Dell XPS'],
                'merchant' => (object)['name' => 'Digital Store'],
                'quantity' => 2,
                'unit_price' => 55000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'total_amount' => 105000,
                'salesman' => (object)['name' => 'Ahmed Khan'],
                'sale_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        @endphp
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Sale Details</h1>
            <a href="{{ route('admin.sales.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                Back
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Sale Information</h3>
                    
                    <div class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Product</label>
                                <p class="text-gray-900 font-semibold">{{ $sale->product->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Merchant</label>
                                <p class="text-gray-900 font-semibold">{{ $sale->merchant->name }}</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-3 gap-6 pt-6 border-t">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Quantity</label>
                                <p class="text-2xl font-bold text-blue-600">{{ $sale->quantity }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Unit Price</label>
                                <p class="text-2xl font-bold text-gray-900">৳{{ number_format($sale->unit_price, 2) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Subtotal</label>
                                <p class="text-2xl font-bold text-gray-900">৳{{ number_format($sale->quantity * $sale->unit_price, 2) }}</p>
                            </div>
                        </div>

                        @if($sale->discount_value > 0)
                            <div class="grid md:grid-cols-2 gap-6 pt-6 border-t">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-2">Discount</label>
                                    <p class="text-xl font-bold text-red-600">
                                        @if($sale->discount_type === 'percentage')
                                            {{ $sale->discount_value }}%
                                        @else
                                            ৳{{ number_format($sale->discount_value, 2) }}
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-2">Discounted Amount</label>
                                    <p class="text-xl font-bold text-gray-900">
                                        ৳{{ number_format($sale->quantity * $sale->unit_price - $sale->total_amount, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="pt-6 border-t">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Total Amount</label>
                            <p class="text-4xl font-bold text-green-600">৳{{ number_format($sale->total_amount, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Additional Information</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Salesman</label>
                            <p class="text-gray-900 font-semibold">{{ $sale->salesman->name ?? 'Not assigned' }}</p>
                        </div>
                        @if($sale->notes)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Notes</label>
                                <p class="text-gray-900">{{ $sale->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Date -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Sale Date</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $sale->sale_date->format('d M Y') }}</p>
                    <p class="text-sm text-gray-600 mt-2">{{ $sale->sale_date->format('H:i A') }}</p>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
                    <form action="{{ route('admin.sales.destroy', $sale) }}" method="POST" 
                        onsubmit="return confirm('Are you sure you want to delete this sale?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                            Delete Sale
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
