<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ {
    Product,
    ProductVariant,
    VariantAttributeValue,
    ProductPrice,
    Inventory,
    ProductImage,
    Tax,
    Attribute,
    AttributeValue,
    Category,
    Brand,
    User
}
;

class ProductSeeder extends Seeder {
    public function run(): void {
        $user     = User::first();
        $category = Category::first();
        $brand    = Brand::first();
        $tax      = Tax::first();

        /* ===  ===  ===  ===  ===  ===  ===  ===  =
        1️⃣ SIMPLE PRODUCTS ( 5 )
        ===  ===  ===  ===  ===  ===  ===  ===  == */
        for ( $i = 1; $i <= 5; $i++ ) {

            $product = Product::create( [
                'name'        => "Simple Product $i",
                'slug'        => Str::slug( "Simple Product $i" ),
                'type'        => 'simple',
                'category_id' => $category->id,
                'brand_id'    => $brand?->id,
                'status'      => true,
                'created_by'  => $user->id
            ] );

            ProductPrice::create( [
                'product_id'      => $product->id,
                'tax_id'          => $tax?->id,
                'mrp'             => rand( 800, 1500 ),
                'selling_price'  => rand( 600, 1200 ),
            ] );

            Inventory::create( [
                'product_id'      => $product->id,
                'sku'             => 'SKU-S-' . strtoupper( Str::random( 6 ) ),
                'stock'           => rand( 20, 100 ),
                'reserved_stock'  => 0,
                'low_stock_qty'   => 5,
                'manage_stock'    => true,
                'stock_status'    => 'in_stock'
            ] );

            ProductImage::create( [
                'product_id' => $product->id,
                'image'      => 'default.png',
                'is_main'    => true
            ] );
        }

        /* ===  ===  ===  ===  ===  ===  ===  ===  =
        2️⃣ VARIABLE PRODUCTS ( 5 )
        ===  ===  ===  ===  ===  ===  ===  ===  == */

        $color = Attribute::where( 'slug', 'color' )->first();
        $size  = Attribute::where( 'slug', 'size' )->first();

        $colors = AttributeValue::where( 'attribute_id', $color->id )->get();
        $sizes  = AttributeValue::where( 'attribute_id', $size->id )->get();

        for ( $i = 1; $i <= 5; $i++ ) {

            $product = Product::create( [
                'name'        => "Variable Product $i",
                'slug'        => Str::slug( "Variable Product $i" ),
                'type'        => 'variable',
                'category_id' => $category->id,
                'brand_id'    => $brand?->id,
                'status'      => true,
                'created_by'  => $user->id
            ] );

            foreach ( $colors as $colorVal ) {
                foreach ( $sizes as $sizeVal ) {

                    $variant = ProductVariant::create( [
                        'product_id' => $product->id,

                        'status'     => true
                    ] );

                    VariantAttributeValue::insert( [
                        [
                            'product_variant_id' => $variant->id,
                            'attribute_id'       => $color->id,
                            'attribute_value_id' => $colorVal->id
                        ],
                        [
                            'product_variant_id' => $variant->id,
                            'attribute_id'       => $size->id,
                            'attribute_value_id' => $sizeVal->id
                        ]
                    ] );

                    ProductPrice::create( [
                        'product_id'         => $product->id,   // 🔥 REQUIRED
                        'product_variant_id' => $variant->id,
                        'tax_id'             => $tax->id,
                        'mrp'                => rand( 1500, 2500 ),
                        'selling_price'      => rand( 1200, 2000 ),
                    ] );

                    Inventory::create( [
                        'product_id'         => $product->id,
                        'product_variant_id' => $variant->id,
                        'sku'        => 'SKU-V-' . strtoupper( Str::random( 6 ) ),
                        'stock'              => rand( 5, 50 ),
                        'reserved_stock'     => 0,
                        'low_stock_qty'      => 5,
                        'manage_stock'       => true,
                        'stock_status'       => 'in_stock'
                    ] );
                }
            }

            ProductImage::create( [
                'product_id' => $product->id,
                'image'      => 'default.png',
                'is_main'    => true
            ] );
        }
    }
}