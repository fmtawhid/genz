<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'buy_price',
        'sale_price',
        'stock_quantity',
        'supplier_id',
        'merchant_id',
        'sku',
        'barcode',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'buy_price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Accessors
    public function getProfitAttribute()
    {
        return $this->sale_price - $this->buy_price;
    }

    public function getProfitMarginAttribute()
    {
        if ($this->buy_price == 0) return 0;
        return (($this->sale_price - $this->buy_price) / $this->buy_price) * 100;
    }
}
