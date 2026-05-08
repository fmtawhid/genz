<?php

namespace App\Services;

class PosService
{
    /**
     * Calculate discount amount based on type
     */
    public function calculateDiscount($subtotal, $discountType, $discountValue)
    {
        if ($discountValue <= 0) {
            return 0;
        }

        if ($discountType === 'percentage') {
            return ($subtotal * $discountValue) / 100;
        }

        return $discountValue; // fixed amount
    }

    /**
     * Calculate final total with discount
     */
    public function calculateTotal($subtotal, $discountType, $discountValue)
    {
        $discount = $this->calculateDiscount($subtotal, $discountType, $discountValue);
        return $subtotal - $discount;
    }

    /**
     * Validate cart items
     */
    public function validateCartItem($productId, $quantity, $price)
    {
        $errors = [];

        if (!$productId || $productId <= 0) {
            $errors[] = 'Invalid product ID';
        }

        if ($quantity <= 0) {
            $errors[] = 'Quantity must be greater than 0';
        }

        if ($price < 0) {
            $errors[] = 'Price cannot be negative';
        }

        return $errors;
    }

    /**
     * Validate discount input
     */
    public function validateDiscount($discountType, $discountValue)
    {
        $errors = [];

        if (!in_array($discountType, ['fixed', 'percentage'])) {
            $errors[] = 'Invalid discount type';
        }

        if ($discountValue < 0) {
            $errors[] = 'Discount cannot be negative';
        }

        if ($discountType === 'percentage' && $discountValue > 100) {
            $errors[] = 'Percentage discount cannot exceed 100%';
        }

        return $errors;
    }

    /**
     * Format cart for display/storage
     */
    public function formatCartData($items, $subtotal, $discountType, $discountValue)
    {
        $discountAmount = $this->calculateDiscount($subtotal, $discountType, $discountValue);
        $total = $subtotal - $discountAmount;

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'discount_type' => $discountType,
            'discount_value' => $discountValue,
            'discount_amount' => $discountAmount,
            'total' => $total,
            'item_count' => count($items),
        ];
    }
}
