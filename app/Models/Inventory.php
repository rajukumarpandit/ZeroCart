<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'sku',
        'stock',
        'reserved_stock',
        'low_stock_qty',
        'manage_stock',
        'stock_status',
    ];

    /* ===============================
       Relationships
    =============================== */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    /* ===============================
       Accessors
    =============================== */

    // Real available stock (VERY IMPORTANT)
    public function getAvailableStockAttribute()
    {
        return max(0, $this->stock - $this->reserved_stock);
    }

    public function getIsLowStockAttribute()
    {
        return $this->available_stock <= $this->low_stock_qty;
    }

    public function getIsOutOfStockAttribute()
    {
        return $this->available_stock <= 0;
    }
}