@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Reports</h1>
            <p class="text-gray-600 text-sm mt-1">View sales, products, and merchant analytics</p>
        </div>

        <!-- Report Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <!-- Sales Report -->
            <a href="{{ route('admin.reports.sales') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition cursor-pointer">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Sales Report</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">View Sales</h3>
                    </div>
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <p class="text-gray-600 text-sm">Track daily and monthly sales with filtering</p>
            </a>

            <!-- Products Report -->
            <!-- <a href="{{ route('admin.reports.products') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition cursor-pointer">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Products Report</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">View Products</h3>
                    </div>
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <p class="text-gray-600 text-sm">Analyze product sales and revenue</p>
            </a> -->

            <!-- Merchants Report -->
            <a href="{{ route('admin.reports.merchants') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition cursor-pointer">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Sallers Report</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">View Sallers </h3>
                    </div>
                    <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                </div>
                <p class="text-gray-600 text-sm">Track sallers sales and performance</p>
            </a>
        </div>
    </main>
@endsection
