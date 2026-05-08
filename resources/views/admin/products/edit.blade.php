@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
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
            @php
                // Dummy product for editing
                $product = (object)[
                    'id' => 1,
                    'name' => 'Laptop Dell XPS',
                    'sku' => 'SKU-001',
                    'description' => 'High-performance laptop',
                    'buy_price' => 45000,
                    'sale_price' => 55000,
                    'stock_quantity' => 15,
                    'supplier_id' => 1,
                    'merchant_id' => 1,
                    'barcode' => 'BAR-001',
                    'is_active' => true
                ];
            @endphp
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('name') border-red-500 @enderror" 
                            placeholder="Enter product name" required>
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- SKU -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('sku') border-red-500 @enderror" 
                            placeholder="e.g., PROD-001">
                        @error('sku') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700"
                        placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Buy Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Buy Price <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">৳</span>
                            <input type="number" name="buy_price" value="{{ old('buy_price', $product->buy_price) }}" step="0.01"
                                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('buy_price') border-red-500 @enderror" 
                                placeholder="0.00" required>
                        </div>
                        @error('buy_price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Sale Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Sale Price <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">৳</span>
                            <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01"
                                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('sale_price') border-red-500 @enderror" 
                                placeholder="0.00" required>
                        </div>
                        @error('sale_price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Stock Quantity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Stock Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('stock_quantity') border-red-500 @enderror" 
                            placeholder="0" required>
                        @error('stock_quantity') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Supplier -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                        @php
                            $suppliers = collect([
                                (object)['id' => 1, 'name' => 'Tech Supplies Co'],
                                (object)['id' => 2, 'name' => 'Gadget Store'],
                                (object)['id' => 3, 'name' => 'Electronics Hub'],
                            ]);
                        @endphp
                        <select name="supplier_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                            <option value="">-- Select Supplier --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @selected(old('supplier_id', $product->supplier_id) == $supplier->id)>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Merchant -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Merchant</label>
                        @php
                            $merchants = collect([
                                (object)['id' => 1, 'name' => 'Digital Store'],
                                (object)['id' => 2, 'name' => 'Tech Market'],
                                (object)['id' => 3, 'name' => 'Gadget Plus'],
                            ]);
                        @endphp
                        <select name="merchant_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                            <option value="">-- Select Merchant --</option>
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}" @selected(old('merchant_id', $product->merchant_id) == $merchant->id)>
                                    {{ $merchant->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('merchant_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Barcode -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Barcode</label>
                    <input type="text" name="barcode" value="{{ old('barcode', $product->barcode) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700 @error('barcode') border-red-500 @enderror" 
                        placeholder="Enter barcode">
                    @error('barcode') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Active Status -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $product->is_active))
                        class="rounded border-gray-300 text-primary-700 focus:ring-primary-700">
                    <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">Active</label>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-4 border-t">
                    <button type="submit" class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition">
                        Update Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
@endsection
