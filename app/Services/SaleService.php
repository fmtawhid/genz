<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Product;
use Carbon\Carbon;

class SaleService
{
    /**
     * Get all sales with pagination
     */
    public function getAllSales($paginate = 15)
    {
        return Sale::with('product', 'merchant', 'salesman')
            ->orderBy('sale_date', 'desc')
            ->paginate($paginate);
    }

    /**
     * Get sale by ID with relationships
     */
    public function getSaleById($id)
    {
        return Sale::with('product', 'merchant', 'salesman')->findOrFail($id);
    }

    /**
     * Create a new sale record
     */
    public function createSale(array $data)
    {
        $data['total_amount'] = $this->calculateTotal($data);
        return Sale::create($data);
    }

    /**
     * Delete a sale record
     */
    public function deleteSale(Sale $sale)
    {
        return $sale->delete();
    }

    /**
     * Calculate total amount for sale
     */
    public function calculateTotal(array $saleData)
    {
        $subtotal = $saleData['quantity'] * $saleData['unit_price'];
        $discountValue = $saleData['discount_value'] ?? 0;
        $discountType = $saleData['discount_type'] ?? 'fixed';

        if ($discountValue > 0) {
            if ($discountType === 'percentage') {
                $subtotal = $subtotal - ($subtotal * $discountValue / 100);
            } else {
                $subtotal = $subtotal - $discountValue;
            }
        }

        return $subtotal;
    }

    /**
     * Validate sale data
     */
    public function validateSaleData(array $data)
    {
        return [
            'product_id' => 'required|exists:products,id',
            'merchant_id' => 'required|exists:merchants,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'discount_type' => 'sometimes|in:fixed,percentage',
            'discount_value' => 'sometimes|numeric|min:0',
            'sale_date' => 'required|date',
            'salesman_id' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
        ];
    }

    /**
     * Get sales filtered by date range and optional merchant
     */
    public function getSalesFiltered($fromDate, $toDate, $merchantId = null, $salesmanId = null)
    {
        $query = Sale::with('product', 'merchant', 'salesman')
            ->whereBetween('sale_date', [$fromDate, $toDate]);

        if ($merchantId) {
            $query->where('merchant_id', $merchantId);
        }

        if ($salesmanId) {
            $query->where('salesman_id', $salesmanId);
        }

        return $query->orderBy('sale_date', 'desc')->get();
    }

    /**
     * Get sales statistics
     */
    public function getSalesStatistics($fromDate, $toDate)
    {
        $sales = Sale::whereBetween('sale_date', [$fromDate, $toDate])->get();

        return [
            'total_amount' => $sales->sum('total_amount'),
            'total_quantity' => $sales->sum('quantity'),
            'transaction_count' => $sales->count(),
            'average_transaction' => $sales->count() > 0 ? $sales->sum('total_amount') / $sales->count() : 0,
        ];
    }

    /**
     * Get daily sales breakdown
     */
    public function getDailySalesBreakdown($fromDate, $toDate)
    {
        return Sale::selectRaw('DATE(sale_date) as date, SUM(total_amount) as amount, COUNT(*) as count')
            ->whereBetween('sale_date', [$fromDate, $toDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}
