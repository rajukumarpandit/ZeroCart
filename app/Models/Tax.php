<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'rate',
        'type',
        'applies_to',
        'is_default',
        'status',
    ];

    /* ===============================
       Relationships
    =============================== */

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    /* ===============================
       Scopes
    =============================== */

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}