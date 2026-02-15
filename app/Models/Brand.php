<?php

// app/Models/Brand.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'position',
        'status',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'updated_by',
    ];

    // protected static function booted()
    // {
    //     static::creating(function ($brand) {
    //         $brand->slug = Str::slug($brand->name);
    //         $brand->created_by = auth()->id();
    //     });

    //     static::updating(function ($brand) {
    //         $brand->slug = Str::slug($brand->name);
    //         $brand->updated_by = auth()->id();
    //     });
    // }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updator(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}