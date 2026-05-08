<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'merchant_id',
        'quantity',
        'unit_price',
        'discount_type',
        'discount_value',
        'total_amount',
        'sale_date',
        'salesman_id',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'discount_value' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'quantity' => 'integer',
            'sale_date' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }

    // Accessors
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_type === 'percentage') {
            return $this->unit_price - ($this->unit_price * $this->discount_value / 100);
        } else {
            return $this->unit_price - $this->discount_value;
        }
    }
}
