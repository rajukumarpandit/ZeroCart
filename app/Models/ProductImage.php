<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductImage extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'image',
        'is_main',
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
}