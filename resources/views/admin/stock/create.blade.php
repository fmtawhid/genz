@extends('admin.layout.layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Add Stock</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                        <option>Select Product</option>
                        <option value="napa">Napa</option>
                        <option value="parasitamol">Paracetamol</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700">
                        <option>Select Supplier</option>
                        <option value="square">square</option>
                        <option value="beximco">beximco</option>
                        
                    </select>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700" placeholder="Enter quantity">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Purchase Price (Optional)</label>
                    <input type="number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-700" placeholder="Enter purchase price"> 
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800">Add Stock</button>
                    <button type="reset" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                </div>
            </form>
        </div>
    </main>
@endsection
