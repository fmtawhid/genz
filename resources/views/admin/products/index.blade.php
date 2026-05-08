@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Products</h1>
                <p class="text-gray-600 text-sm mt-1">Manage your product inventory</p>
            </div>
            <a href="{{ route('admin.products.create') }}" 
                class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium shadow-sm">
                + Add Product
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

        <!-- Product Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Table Stats -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <p class="text-sm text-gray-600">Showing <strong>5</strong> of <strong>5</strong> products</p>
            </div>

            <!-- Table -->
            @php
                $products = collect([
                    (object)['id' => 1, 'name' => 'Laptop Dell XPS', 'sku' => 'SKU-001', 'buy_price' => 45000, 'sale_price' => 55000, 'profit_margin' => 22.2, 'stock_quantity' => 15, 'supplier' => (object)['name' => 'Tech Supplies Co'], 'is_active' => true, 'created_at' => now()],
                    (object)['id' => 2, 'name' => 'USB-C Cable', 'sku' => 'SKU-002', 'buy_price' => 150, 'sale_price' => 249, 'profit_margin' => 66, 'stock_quantity' => 5, 'supplier' => (object)['name' => 'Gadget Store'], 'is_active' => true, 'created_at' => now()->subDays(2)],
                    (object)['id' => 3, 'name' => 'Wireless Mouse', 'sku' => 'SKU-003', 'buy_price' => 600, 'sale_price' => 999, 'profit_margin' => 66.5, 'stock_quantity' => 25, 'supplier' => (object)['name' => 'Electronics Hub'], 'is_active' => true, 'created_at' => now()->subDays(5)],
                    (object)['id' => 4, 'name' => '4K Monitor', 'sku' => 'SKU-004', 'buy_price' => 12000, 'sale_price' => 16000, 'profit_margin' => 33.3, 'stock_quantity' => 3, 'supplier' => (object)['name' => 'Tech Supplies Co'], 'is_active' => true, 'created_at' => now()->subDays(7)],
                    (object)['id' => 5, 'name' => 'Mechanical Keyboard', 'sku' => 'SKU-005', 'buy_price' => 2500, 'sale_price' => 3999, 'profit_margin' => 59.96, 'stock_quantity' => 0, 'supplier' => (object)['name' => 'Gadget Store'], 'is_active' => false, 'created_at' => now()->subDays(10)],
                ]);
            @endphp
            @if($products->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Product</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">SKU</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Buy Price</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Sale Price</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Profit Margin</th>
                                <th class="text-center py-4 px-6 font-semibold text-gray-700 text-sm">Stock</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Supplier</th>
                                <th class="text-center py-4 px-6 font-semibold text-gray-700 text-sm">Status</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 px-6">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-500 mt-1">Added {{ $product->created_at->diffForHumans() }}</p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $product->sku ?? '-' }}</td>
                                    <td class="py-4 px-6 text-right text-sm text-gray-700">
                                        <span class="inline-block bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ৳{{ number_format($product->buy_price, 2) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right text-sm text-gray-700">
                                        <span class="inline-block bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ৳{{ number_format($product->sale_price, 2) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right text-sm">
                                        @if($product->buy_price > 0)
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                                @if($product->profit_margin >= 20) bg-green-100 text-green-700
                                                @elseif($product->profit_margin >= 10) bg-yellow-100 text-yellow-700
                                                @else bg-red-100 text-red-700
                                                @endif">
                                                {{ number_format($product->profit_margin, 1) }}%
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">N/A</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-block px-3 py-1 rounded-lg text-xs font-semibold
                                            @if($product->stock_quantity > 10) bg-green-100 text-green-700
                                            @elseif($product->stock_quantity > 0) bg-yellow-100 text-yellow-700
                                            @else bg-red-100 text-red-700
                                            @endif">
                                            {{ $product->stock_quantity }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-700">
                                        {{ $product->supplier->name ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        @if($product->is_active)
                                            <span class="inline-block px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Active</span>
                                        @else
                                            <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                                                class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-1 rounded transition text-sm font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" 
                                                onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-1 rounded transition text-sm font-medium">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <!-- No pagination for dummy data -->
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Yet</h3>
                    <p class="text-gray-600 mb-6">Get started by creating your first product</p>
                    <a href="{{ route('admin.products.create') }}" class="inline-block px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium">
                        Create Product
                    </a>
                </div>
            @endif
        </div>
    </main>
@endsection
