<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'status',
    ];

    /* ===============================
       Relationships
    =============================== */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function attributeValues()
    // {
    //     return $this->belongsToMany(
    //         AttributeValue::class,
    //         'variant_attribute_values'
    //     );
    // }
    public function attributeValues()
    {
        return $this->belongsToMany(
            AttributeValue::class,
            'variant_attribute_values'
        )
        ->using(VariantAttributeValue::class)
        ->withPivot('attribute_id')
        ->withTimestamps();
    }


    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
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
            ->where('is_main', true);
    }
}