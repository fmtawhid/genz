@extends('merchant.layout.layout')

@section('content')
    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Today's Medicine Sales</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">৳ 12,450</p>
                    </div>
                    <div class="bg-green-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-pills text-green-600"></i>
                    </div>
                </div>
                <p class="text-xs text-green-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> 22.5% vs yesterday</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Prescriptions Today</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">87</p>
                    </div>
                    <div class="bg-blue-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-prescription text-blue-600"></i>
                    </div>
                </div>
                <p class="text-xs text-blue-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> 15.3% vs yesterday</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-purple-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Items in Stock</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">245</p>
                    </div>
                    <div class="bg-purple-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-box text-purple-600"></i>
                    </div>
                </div>
                <p class="text-xs text-purple-600 mt-2"><i class="fas fa-check mr-1"></i> All categories OK</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-red-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Expiry Due Soon</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">8</p>
                    </div>
                    <div class="bg-red-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                </div>
                <p class="text-xs text-red-600 mt-2"><i class="fas fa-alert-circle mr-1"></i> Within 30 days</p>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
            <!-- Hourly Sales Chart -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-4 md:p-5">
                <div class="flex justify-between items-center mb-4 md:mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Hourly Sales Performance</h3>
                    <div class="flex space-x-2">
                        <button
                            class="px-3 py-1 text-xs bg-primary-100 text-primary-700 rounded-lg">Today</button>
                        <button
                            class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg">This Week</button>
                        <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg">This Month</button>
                    </div>
                </div>
                <div class="h-48 md:h-64 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-200">
                    <div class="text-center w-full">
                        <p class="text-gray-700 font-medium mb-3">Today's Hourly Medicine Sales</p>
                        <div class="flex justify-around items-end h-32 px-2">
                            <div class="flex flex-col items-center">
                                <div class="bg-green-500 w-6 rounded" style="height: 20px;"></div>
                                <p class="text-xs text-gray-600 mt-1">9AM</p>
                                <p class="text-xs font-medium">৳ 850</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-green-500 w-6 rounded" style="height: 45px;"></div>
                                <p class="text-xs text-gray-600 mt-1">10AM</p>
                                <p class="text-xs font-medium">৳ 1.2k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-green-500 w-6 rounded" style="height: 50px;"></div>
                                <p class="text-xs text-gray-600 mt-1">11AM</p>
                                <p class="text-xs font-medium">৳ 1.5k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-green-500 w-6 rounded" style="height: 65px;"></div>
                                <p class="text-xs text-gray-600 mt-1">12PM</p>
                                <p class="text-xs font-medium">৳ 2.1k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-green-500 w-6 rounded" style="height: 55px;"></div>
                                <p class="text-xs text-gray-600 mt-1">1PM</p>
                                <p class="text-xs font-medium">৳ 1.8k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-green-500 w-6 rounded" style="height: 35px;"></div>
                                <p class="text-xs text-gray-600 mt-1">2PM</p>
                                <p class="text-xs font-medium">৳ 950</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-green-500 w-6 rounded" style="height: 40px;"></div>
                                <p class="text-xs text-gray-600 mt-1">3PM</p>
                                <p class="text-xs font-medium">৳ 1.1k</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Selling Medicines -->
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 md:mb-6">Top Selling Medicines</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Paracetamol 500mg</p>
                            <div class="w-24 h-2 bg-gray-200 rounded mt-1">
                                <div class="h-full w-5/6 bg-green-500 rounded"></div>
                            </div>
                        </div>
                        <div class="text-right ml-3">
                            <p class="font-medium text-gray-800">245 units</p>
                            <p class="text-xs text-gray-500">42% of sales</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Amoxicillin 250mg</p>
                            <div class="w-24 h-2 bg-gray-200 rounded mt-1">
                                <div class="h-full w-4/6 bg-blue-500 rounded"></div>
                            </div>
                        </div>
                        <div class="text-right ml-3">
                            <p class="font-medium text-gray-800">156 units</p>
                            <p class="text-xs text-gray-500">27% of sales</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Cetirizine 10mg</p>
                            <div class="w-24 h-2 bg-gray-200 rounded mt-1">
                                <div class="h-full w-3/6 bg-purple-500 rounded"></div>
                            </div>
                        </div>
                        <div class="text-right ml-3">
                            <p class="font-medium text-gray-800">98 units</p>
                            <p class="text-xs text-gray-500">17% of sales</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Omeprazole 20mg</p>
                            <div class="w-24 h-2 bg-gray-200 rounded mt-1">
                                <div class="h-full w-2/6 bg-orange-500 rounded"></div>
                            </div>
                        </div>
                        <div class="text-right ml-3">
                            <p class="font-medium text-gray-800">54 units</p>
                            <p class="text-xs text-gray-500">9% of sales</p>
                        </div>
                    </div>
                </div>
                <button
                    class="w-full mt-4 py-2 text-sm text-primary-700 font-medium rounded-lg border border-primary-200 hover:bg-primary-50">
                    View Inventory
                </button>
            </div>
        </div>

        <!-- Quick Actions & Status -->
        <div class="mt-6 bg-white rounded-xl shadow-sm p-4 md:p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pharmacy Operations</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">POS Terminal</p>
                        <p class="text-xs text-gray-500">Connected & Active</p>
                    </div>
                </div>
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Barcode Scanner</p>
                        <p class="text-xs text-gray-500">Operational</p>
                    </div>
                </div>
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Printer</p>
                        <p class="text-xs text-gray-500">Ready for receipts</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
     
   