@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Products Report</h1>
            <p class="text-gray-600 text-sm mt-1">View product performance and sales metrics</p>
        </div>

        <!-- Summary Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-6">
            @php
                $products = collect([
                    (object)[
                        'name' => 'Laptop Dell XPS',
                        'buy_price' => 45000,
                        'sale_price' => 55000,
                        'stock_quantity' => 15,
                        'total_sold' => 8,
                        'total_revenue' => 440000,
                        'supplier' => (object)['name' => 'Tech Supplies Co'],
                    ],
                    (object)[
                        'name' => 'Wireless Mouse',
                        'buy_price' => 600,
                        'sale_price' => 999,
                        'stock_quantity' => 25,
                        'total_sold' => 45,
                        'total_revenue' => 44955,
                        'supplier' => (object)['name' => 'Electronics Hub'],
                    ],
                    (object)[
                        'name' => 'USB-C Cable',
                        'buy_price' => 150,
                        'sale_price' => 249,
                        'stock_quantity' => 5,
                        'total_sold' => 125,
                        'total_revenue' => 31125,
                        'supplier' => (object)['name' => 'Gadget Store'],
                    ],
                    (object)[
                        'name' => '4K Monitor',
                        'buy_price' => 12000,
                        'sale_price' => 16000,
                        'stock_quantity' => 3,
                        'total_sold' => 12,
                        'total_revenue' => 192000,
                        'supplier' => (object)['name' => 'Tech Supplies Co'],
                    ],
                ]);
            @endphp
            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-gray-600 text-sm font-medium mb-2">Total Products</p>
                <p class="text-4xl font-bold text-blue-600">{{ $products->count() }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-gray-600 text-sm font-medium mb-2">Total Revenue</p>
                <p class="text-4xl font-bold text-green-600">৳{{ number_format($products->sum('total_revenue'), 2) }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-gray-600 text-sm font-medium mb-2">Total Units Sold</p>
                <p class="text-4xl font-bold text-purple-600">{{ $products->sum('total_sold') }} units</p>
            </div>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <p class="text-sm text-gray-600">Showing <strong>{{ $products->count() }}</strong> products</p>
            </div>

            @if($products->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Product Name</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Supplier</th>
                                <th class="text-center py-4 px-6 font-semibold text-gray-700 text-sm">Units Sold</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Buy Price</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Sale Price</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Total Revenue</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Stock</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6 text-sm font-semibold text-gray-900">{{ $product->name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $product->supplier->name ?? '-' }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $product->total_sold }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right text-sm text-gray-700">৳{{ number_format($product->buy_price, 2) }}</td>
                                    <td class="py-4 px-6 text-right text-sm text-gray-700">৳{{ number_format($product->sale_price, 2) }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            ৳{{ number_format($product->total_revenue, 2) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                            @if($product->stock_quantity > 10) bg-green-100 text-green-700
                                            @elseif($product->stock_quantity > 0) bg-yellow-100 text-yellow-700
                                            @else bg-red-100 text-red-700
                                            @endif">
                                            {{ $product->stock_quantity }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No products found.</p>
                </div>
            @endif
        </div>
    </main>
@endsection
