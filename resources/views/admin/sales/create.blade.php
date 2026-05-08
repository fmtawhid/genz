@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Record Sale</h1>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <h3 class="text-red-800 font-semibold mb-2">Please fix the following errors:</h3>
                <ul class="text-red-700 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('admin.sales.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Product -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Product <span class="text-red-500">*</span>
                        </label>
                        @php
                            $products = collect([
                                (object)['id' => 1, 'name' => 'Laptop Dell XPS', 'sale_price' => 55000],
                                (object)['id' => 2, 'name' => 'USB-C Cable', 'sale_price' => 249],
                                (object)['id' => 3, 'name' => 'Wireless Mouse', 'sale_price' => 999],
                                (object)['id' => 4, 'name' => '4K Monitor', 'sale_price' => 16000],
                            ]);
                        @endphp
                        <select name="product_id" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('product_id') border-red-500 @enderror">
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                                    {{ $product->name }} (৳{{ number_format($product->sale_price, 2) }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Merchant -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Merchant <span class="text-red-500">*</span>
                        </label>
                        @php
                            $merchants = collect([
                                (object)['id' => 1, 'name' => 'Digital Store'],
                                (object)['id' => 2, 'name' => 'Tech Market'],
                                (object)['id' => 3, 'name' => 'Gadget Plus'],
                            ]);
                        @endphp
                        <select name="merchant_id" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('merchant_id') border-red-500 @enderror">
                            <option value="">-- Select Merchant --</option>
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}" @selected(old('merchant_id') == $merchant->id)>
                                    {{ $merchant->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('merchant_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Quantity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('quantity') border-red-500 @enderror">
                        @error('quantity') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Unit Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Unit Price <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">৳</span>
                            <input type="number" name="unit_price" value="{{ old('unit_price') }}" step="0.01" required
                                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('unit_price') border-red-500 @enderror"
                                placeholder="0.00">
                        </div>
                        @error('unit_price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Sale Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Sale Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="sale_date" value="{{ old('sale_date', now()->format('Y-m-d')) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('sale_date') border-red-500 @enderror">
                        @error('sale_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Discount</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Discount Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Discount Type</label>
                            <select name="discount_type" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                                <option value="fixed" @selected(old('discount_type') == 'fixed')>Fixed Amount</option>
                                <option value="percentage" @selected(old('discount_type') == 'percentage')>Percentage (%)</option>
                            </select>
                        </div>

                        <!-- Discount Value -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Discount Value</label>
                            <input type="number" name="discount_value" value="{{ old('discount_value', 0) }}" min="0" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700"
                                placeholder="0">
                            @error('discount_value') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Salesman -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Salesman</label>
                        <select name="salesman_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                            <option value="">-- Select Salesman --</option>
                            @foreach($salesmen as $salesman)
                                <option value="{{ $salesman->id }}" @selected(old('salesman_id') == $salesman->id)>
                                    {{ $salesman->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <input type="text" name="notes" value="{{ old('notes') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700"
                            placeholder="Add any notes about this sale">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-4 border-t">
                    <button type="submit" class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition">
                        Record Sale
                    </button>
                    <a href="{{ route('admin.sales.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
@endsection
