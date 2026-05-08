<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Merchant;
use Carbon\Carbon;

class ReportService
{
    /**
     * Get product performance data
     */
    public function getProductReport()
    {
        $products = Product::with('supplier')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $products->each(function ($product) {
            $product->total_sold = $product->sales()->sum('quantity');
            $product->total_revenue = $product->sales()->sum('total_amount');
        });

        return $products;
    }

    /**
     * Get merchant performance data
     */
    public function getMerchantReport()
    {
        $merchants = Merchant::where('is_active', true)
            ->withCount('sales')
            ->get();

        $merchants->each(function ($merchant) {
            $merchant->total_spent = $merchant->sales()->sum('total_amount');
            $merchant->total_purchases = $merchant->sales()->count();
            $merchant->average_purchase = $merchant->total_purchases > 0 
                ? $merchant->total_spent / $merchant->total_purchases 
                : 0;
        });

        return $merchants;
    }

    /**
     * Get summary statistics
     */
    public function getSummaryStats($fromDate = null, $toDate = null)
    {
        if (!$fromDate) {
            $fromDate = now()->startOfMonth();
        }
        if (!$toDate) {
            $toDate = now()->endOfDay();
        }

        $sales = Sale::whereBetween('sale_date', [$fromDate, $toDate])->get();

        return [
            'total_sales' => $sales->sum('total_amount'),
            'total_transactions' => $sales->count(),
            'total_items_sold' => $sales->sum('quantity'),
            'average_transaction_value' => $sales->count() > 0 
                ? $sales->sum('total_amount') / $sales->count() 
                : 0,
        ];
    }

    /**
     * Get top selling products
     */
    public function getTopSellingProducts($limit = 10, $fromDate = null, $toDate = null)
    {
        $query = Sale::with('product')
            ->selectRaw('product_id, SUM(quantity) as total_quantity, SUM(total_amount) as total_revenue')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity');

        if ($fromDate && $toDate) {
            $query->whereBetween('sale_date', [$fromDate, $toDate]);
        }

        return $query->limit($limit)->get();
    }

    /**
     * Get top merchants
     */
    public function getTopMerchants($limit = 10, $fromDate = null, $toDate = null)
    {
        $query = Sale::with('merchant')
            ->selectRaw('merchant_id, COUNT(*) as transaction_count, SUM(total_amount) as total_spent')
            ->groupBy('merchant_id')
            ->orderByDesc('total_spent');

        if ($fromDate && $toDate) {
            $query->whereBetween('sale_date', [$fromDate, $toDate]);
        }

        return $query->limit($limit)->get();
    }

    /**
     * Get daily revenue trend
     */
    public function getDailyRevenueTrend($fromDate, $toDate)
    {
        return Sale::selectRaw('DATE(sale_date) as date, SUM(total_amount) as revenue, COUNT(*) as transactions')
            ->whereBetween('sale_date', [$fromDate, $toDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    /**
     * Get discount summary
     */
    public function getDiscountSummary($fromDate = null, $toDate = null)
    {
        $query = Sale::where('discount_value', '>', 0);

        if ($fromDate && $toDate) {
            $query->whereBetween('sale_date', [$fromDate, $toDate]);
        }

        $sales = $query->get();

        $totalDiscounted = $sales->sum('discount_value');
        $percentageDiscounts = $sales->where('discount_type', 'percentage')->sum('discount_value');
        $fixedDiscounts = $sales->where('discount_type', 'fixed')->sum('discount_value');

        return [
            'total_discounted_sales' => $sales->count(),
            'total_discount_amount' => $totalDiscounted,
            'percentage_discount_count' => $sales->where('discount_type', 'percentage')->count(),
            'fixed_discount_count' => $sales->where('discount_type', 'fixed')->count(),
            'average_discount' => $sales->count() > 0 ? $totalDiscounted / $sales->count() : 0,
        ];
    }
}
