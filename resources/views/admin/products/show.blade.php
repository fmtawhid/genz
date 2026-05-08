@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        @php
            // Dummy product for display
            $product = (object)[
                'id' => 1,
                'name' => 'Laptop Dell XPS',
                'sku' => 'SKU-001',
                'description' => 'High-performance laptop with 13-inch display',
                'buy_price' => 45000,
                'sale_price' => 55000,
                'profit' => 10000,
                'profit_margin' => 22.2,
                'stock_quantity' => 15,
                'barcode' => 'BAR-001',
                'is_active' => true,
                'supplier' => (object)['name' => 'Tech Supplies Co'],
                'merchant' => (object)['name' => 'Digital Store'],
                'created_at' => now()->subDays(30),
                'updated_at' => now(),
            ];
        @endphp
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                <p class="text-gray-600 text-sm mt-1">Product Details</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Edit
                </a>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Back
                </a>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Product Information</h3>
                    
                    <div class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Product Name</label>
                                <p class="text-gray-900 font-semibold">{{ $product->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">SKU</label>
                                <p class="text-gray-900 font-mono">{{ $product->sku ?? '-' }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Description</label>
                            <p class="text-gray-900">{{ $product->description ?? '-' }}</p>
                        </div>

                        <div class="grid md:grid-cols-3 gap-6 pt-6 border-t">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Buy Price</label>
                                <p class="text-2xl font-bold text-blue-600">৳{{ number_format($product->buy_price, 2) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Sale Price</label>
                                <p class="text-2xl font-bold text-green-600">৳{{ number_format($product->sale_price, 2) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Profit</label>
                                <p class="text-2xl font-bold text-purple-600">৳{{ number_format($product->profit, 2) }}</p>
                                <p class="text-xs text-gray-600 mt-1">{{ number_format($product->profit_margin, 1) }}% margin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stock Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Stock Information</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Current Stock</label>
                            <div class="flex items-center gap-3">
                                <span class="text-4xl font-bold text-gray-900">{{ $product->stock_quantity }}</span>
                                <span class="text-sm text-gray-600">units</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Stock Status</label>
                            <p class="text-lg">
                                @if($product->stock_quantity > 10)
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">In Stock</span>
                                @elseif($product->stock_quantity > 0)
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">Low Stock</span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold">Out of Stock</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div>
                <!-- Status -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status</h3>
                    <div class="flex items-center gap-3">
                        @if($product->is_active)
                            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                            <span class="text-gray-900 font-semibold">Active</span>
                        @else
                            <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                            <span class="text-gray-900 font-semibold">Inactive</span>
                        @endif
                    </div>
                </div>

                <!-- Supplier Info -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Supplier</h3>
                    @if($product->supplier)
                        <div>
                            <p class="text-gray-900 font-semibold">{{ $product->supplier->name }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ $product->supplier->email ?? '-' }}</p>
                            <p class="text-sm text-gray-600">{{ $product->supplier->phone ?? '-' }}</p>
                        </div>
                    @else
                        <p class="text-gray-600">No supplier assigned</p>
                    @endif
                </div>

                <!-- Merchant Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Merchant</h3>
                    @if($product->merchant)
                        <div>
                            <p class="text-gray-900 font-semibold">{{ $product->merchant->name }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ $product->merchant->email ?? '-' }}</p>
                        </div>
                    @else
                        <p class="text-gray-600">No merchant assigned</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Barcode -->
        @if($product->barcode)
            <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Barcode</h3>
                <p class="text-gray-900 font-mono text-lg">{{ $product->barcode }}</p>
            </div>
        @endif
    </main>
@endsection
