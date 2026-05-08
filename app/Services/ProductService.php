<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAllProducts($paginate = 15)
    {
        return Product::with('supplier', 'merchant')
            ->orderBy('created_at', 'desc')
            ->paginate($paginate);
    }

    public function getActiveProducts()
    {
        return Product::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function getProductById($id)
    {
        return Product::with('supplier', 'merchant')->findOrFail($id);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function deleteProduct(Product $product)
    {
        return $product->delete();
    }

    public function validateProductData(array $data, $productId = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'buy_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'merchant_id' => 'nullable|exists:merchants,id',
            'sku' => 'nullable|string|unique:products,sku' . ($productId ? ",$productId" : ''),
            'barcode' => 'nullable|string|unique:products,barcode' . ($productId ? ",$productId" : ''),
            'is_active' => 'boolean',
        ];

        return $rules;
    }

    public function calculateProductMetrics(Product $product)
    {
        return [
            'profit' => $product->sale_price - $product->buy_price,
            'profit_margin' => $product->buy_price > 0 ? (($product->sale_price - $product->buy_price) / $product->buy_price) * 100 : 0,
            'stock_status' => $this->getStockStatus($product->stock_quantity),
        ];
    }

    private function getStockStatus($quantity)
    {
        if ($quantity > 10) return 'in_stock';
        if ($quantity > 0) return 'low_stock';
        return 'out_of_stock';
    }
}
