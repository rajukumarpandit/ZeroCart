<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inventory;
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'category_id',
        'brand_id',
        'short_description',
        'description',
        'status',
        'is_featured',
        'created_by',
        'updated_by',
    ];

    /* ===============================
       Relationships
    =============================== */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_main', true)
            ->whereNull('product_variant_id');
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function totalStock()
{
    if ($this->variants()->exists()) {

        return (int) Inventory::whereIn(
                'product_variant_id',
                $this->variants()->pluck('id')
            )->sum('stock');
    }

    return (int) ($this->inventory->stock ?? 0);
}



}