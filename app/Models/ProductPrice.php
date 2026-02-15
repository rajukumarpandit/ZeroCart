<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'mrp',
        'selling_price',
        'tax_id',
        'currency',
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

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    /* ===============================
       Accessors
    =============================== */

    public function getDiscountAttribute()
    {
        if ($this->mrp <= 0) return 0;

        return round(
            (($this->mrp - $this->selling_price) / $this->mrp) * 100,
            2
        );
    }

    public function getFinalPriceAttribute()
    {
        $tax = $this->tax ?? Tax::default()->first();

        if (!$tax) {
            return $this->selling_price;
        }

        return $tax->apply($this->selling_price)['final_price'];
    }
}