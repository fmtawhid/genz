@extends('admin.layout.layout')

@section('content')
    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Pharmacy Revenue</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">৳ 48,750</p>
                    </div>
                    <div class="bg-green-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-pills text-green-600"></i>
                    </div>
                </div>
                <p class="text-xs text-green-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> 18.3% from last month</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Prescriptions Filled</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">1,245</p>
                    </div>
                    <div class="bg-blue-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-prescription text-blue-600"></i>
                    </div>
                </div>
                <p class="text-xs text-blue-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> 9.7% from last month</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-purple-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Active Pharmacies</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">28</p>
                    </div>
                    <div class="bg-purple-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-hospital-user text-purple-600"></i>
                    </div>
                </div>
                <p class="text-xs text-purple-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> 3 new this month</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-orange-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Items Near Expiry</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">34</p>
                    </div>
                    <div class="bg-orange-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-clock text-orange-600"></i>
                    </div>
                </div>
                <p class="text-xs text-orange-600 mt-2"><i class="fas fa-alert-circle mr-1"></i> Requires attention</p>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
            <!-- Sales Trend Chart -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-4 md:p-5">
                <div class="flex justify-between items-center mb-4 md:mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Daily Medicine Sales Trend</h3>
                    <div class="flex space-x-2">
                        <button
                            class="px-3 py-1 text-xs bg-primary-100 text-primary-700 rounded-lg">Weekly</button>
                        <button
                            class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg">Monthly</button>
                        <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg">Yearly</button>
                    </div>
                </div>
                <div class="h-48 md:h-64 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-200">
                    <div class="text-center">
                        <p class="text-gray-700 font-medium mb-3">Weekly Medicine Sales Performance</p>
                        <div class="flex justify-around items-end h-32 px-4">
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 w-8 rounded" style="height: 40px;"></div>
                                <p class="text-xs text-gray-600 mt-2">Mon</p>
                                <p class="text-xs font-medium">৳ 6.2k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 w-8 rounded" style="height: 56px;"></div>
                                <p class="text-xs text-gray-600 mt-2">Tue</p>
                                <p class="text-xs font-medium">৳ 8.8k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 w-8 rounded" style="height: 65px;"></div>
                                <p class="text-xs text-gray-600 mt-2">Wed</p>
                                <p class="text-xs font-medium">৳ 10.1k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 w-8 rounded" style="height: 48px;"></div>
                                <p class="text-xs text-gray-600 mt-2">Thu</p>
                                <p class="text-xs font-medium">৳ 7.5k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 w-8 rounded" style="height: 72px;"></div>
                                <p class="text-xs text-gray-600 mt-2">Fri</p>
                                <p class="text-xs font-medium">৳ 11.3k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 w-8 rounded" style="height: 60px;"></div>
                                <p class="text-xs text-gray-600 mt-2">Sat</p>
                                <p class="text-xs font-medium">৳ 9.4k</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 w-8 rounded" style="height: 45px;"></div>
                                <p class="text-xs text-gray-600 mt-2">Sun</p>
                                <p class="text-xs font-medium">৳ 7.0k</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 md:mb-6">Recent Pharmacy Orders</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div>
                            <p class="font-medium text-gray-800">Amoxicillin 500mg</p>
                            <p class="text-xs text-gray-500">Today, 02:15 PM</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-green-600">৳ 890</p>
                            <p class="text-xs text-green-500">✓ Completed</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div>
                            <p class="font-medium text-gray-800">Aspirin 100mg (30 tabs)</p>
                            <p class="text-xs text-gray-500">Today, 01:45 PM</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-green-600">৳ 350</p>
                            <p class="text-xs text-green-500">✓ Completed</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div>
                            <p class="font-medium text-gray-800">Multivitamin Syrup</p>
                            <p class="text-xs text-gray-500">Today, 12:30 PM</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-green-600">৳ 1,250</p>
                            <p class="text-xs text-green-500">✓ Completed</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-800">Paracetamol 500mg</p>
                            <p class="text-xs text-gray-500">Yesterday, 03:20 PM</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-green-600">৳ 420</p>
                            <p class="text-xs text-green-500">✓ Completed</p>
                        </div>
                    </div>
                </div>
                <button
                    class="w-full mt-4 py-2 text-sm text-primary-700 font-medium rounded-lg border border-primary-200 hover:bg-primary-50">
                    View All Orders
                </button>
            </div>
        </div>

        <!-- Inventory Status -->
        <div class="mt-6 bg-white rounded-xl shadow-sm p-4 md:p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pharmacy System Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Inventory Management</p>
                        <p class="text-xs text-gray-500">345 items in stock</p>
                    </div>
                </div>
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-yellow-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Low Stock Alert</p>
                        <p class="text-xs text-gray-500">12 items need reorder</p>
                    </div>
                </div>
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">POS System</p>
                        <p class="text-xs text-gray-500">All terminals online</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
     
   