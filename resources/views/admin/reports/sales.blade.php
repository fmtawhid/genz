@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Sales Report</h1>
            <p class="text-gray-600 text-sm mt-1">View and filter sales by date and merchant</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Filters</h3>
            <form action="{{ route('admin.reports.sales') }}" method="GET" class="space-y-4">
                <div class="grid md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <input type="date" name="from_date" value="{{ now()->subDays(30)->format('Y-m-d') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <input type="date" name="to_date" value="{{ now()->format('Y-m-d') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Merchant</label>
                        <select name="merchant_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                            <option value="">-- All Merchants --</option>
                            @php
                                $merchants = collect([
                                    (object)['id' => 1, 'name' => 'Digital Store'],
                                    (object)['id' => 2, 'name' => 'Tech Market'],
                                    (object)['id' => 3, 'name' => 'Gadget Plus'],
                                ]);
                            @endphp
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}" @selected(request('merchant_id') == $merchant->id)>
                                    {{ $merchant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-4 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Statistics -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-gray-600 text-sm font-medium mb-2">Total Sales Amount</p>
                <p class="text-4xl font-bold text-green-600">৳125,985.50</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-gray-600 text-sm font-medium mb-2">Total Quantity Sold</p>
                <p class="text-4xl font-bold text-blue-600">18 units</p>
            </div>
        </div>

        <!-- Daily Sales Chart Data -->
        @php
            $daily_sales = collect([
                (object)['date' => now()->subDays(3)->format('Y-m-d'), 'amount' => 45000, 'count' => 2],
                (object)['date' => now()->subDays(2)->format('Y-m-d'), 'amount' => 36490, 'count' => 2],
                (object)['date' => now()->subDays(1)->format('Y-m-d'), 'amount' => 31000, 'count' => 1],
                (object)['date' => now()->format('Y-m-d'), 'amount' => 13495.5, 'count' => 2],
            ]);
            
            $sales = collect([
                (object)['sale_date' => now()->subDays(3), 'product' => (object)['name' => 'Laptop Dell XPS'], 'merchant' => (object)['name' => 'Digital Store'], 'quantity' => 2, 'total_amount' => 105000, 'id' => 1],
                (object)['sale_date' => now()->subDays(3), 'product' => (object)['name' => '4K Monitor'], 'merchant' => (object)['name' => 'Tech Market'], 'quantity' => 1, 'total_amount' => 15000, 'id' => 2],
                (object)['sale_date' => now()->subDays(2), 'product' => (object)['name' => 'Wireless Mouse'], 'merchant' => (object)['name' => 'Gadget Plus'], 'quantity' => 5, 'total_amount' => 4495.5, 'id' => 3],
                (object)['sale_date' => now()->subDays(2), 'product' => (object)['name' => 'USB-C Cable'], 'merchant' => (object)['name' => 'Digital Store'], 'quantity' => 15, 'total_amount' => 3735, 'id' => 4],
                (object)['sale_date' => now()->subDays(1), 'product' => (object)['name' => 'Mechanical Keyboard'], 'merchant' => (object)['name' => 'Tech Market'], 'quantity' => 2, 'total_amount' => 7998, 'id' => 5],
                (object)['sale_date' => now(), 'product' => (object)['name' => 'Wireless Mouse'], 'merchant' => (object)['name' => 'Gadget Plus'], 'quantity' => 3, 'total_amount' => 2997, 'id' => 6],
                (object)['sale_date' => now(), 'product' => (object)['name' => 'USB-C Cable'], 'merchant' => (object)['name' => 'Digital Store'], 'quantity' => 5, 'total_amount' => 1245, 'id' => 7],
                (object)['sale_date' => now(), 'product' => (object)['name' => 'Laptop Dell XPS'], 'merchant' => (object)['name' => 'Tech Market'], 'quantity' => 1, 'total_amount' => 52500, 'id' => 8],
            ]);
        @endphp
        @if($daily_sales->count() > 0)
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Daily Sales Breakdown</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                                <th class="text-right py-3 px-4 font-semibold text-gray-700">Sales Amount</th>
                                <th class="text-right py-3 px-4 font-semibold text-gray-700">Transactions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($daily_sales as $day)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-900">{{ Carbon\Carbon::parse($day->date)->format('d M Y') }}</td>
                                    <td class="py-3 px-4 text-right font-semibold text-gray-900">৳{{ number_format($day->amount, 2) }}</td>
                                    <td class="py-3 px-4 text-right text-gray-700">{{ $day->count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Sales Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <p class="text-sm text-gray-600">Showing <strong>{{ $sales->count() }}</strong> sales</p>
            </div>

            @if($sales->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Date</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Product</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-700 text-sm">Merchant</th>
                                <th class="text-center py-4 px-6 font-semibold text-gray-700 text-sm">Qty</th>
                                <th class="text-right py-4 px-6 font-semibold text-gray-700 text-sm">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($sales as $sale)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-700">{{ $sale->sale_date->format('d-m-Y') }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-900">{{ $sale->product->name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $sale->merchant->name }}</td>
                                    <td class="py-4 px-6 text-center text-sm text-gray-700">{{ $sale->quantity }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="inline-block bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ৳{{ number_format($sale->total_amount, 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination disabled for dummy data -->
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No sales found for the selected date range.</p>
                </div>
            @endif
        </div>
    </main>
@endsection
