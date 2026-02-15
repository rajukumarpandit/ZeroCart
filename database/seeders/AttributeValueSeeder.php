<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'color' => ['Red', 'Blue', 'Black', 'White', 'Green'],
            'size'  => ['S', 'M', 'L', 'XL', 'XXL'],
            'ram'   => ['4GB', '6GB', '8GB', '12GB'],
            'storage' => ['64GB', '128GB', '256GB', '512GB'],
            'material' => ['Cotton', 'Leather', 'Plastic', 'Metal'],
            'weight' => ['500g', '1kg', '2kg'],
        ];

        foreach ($data as $attrSlug => $values) {

            $attribute = Attribute::where('slug', $attrSlug)->first();

            if (!$attribute) continue;

            foreach ($values as $value) {
                AttributeValue::firstOrCreate([
                    'attribute_id' => $attribute->id,
                    'slug' => Str::slug($value)
                ], [
                    'value' => $value,
                    'status' => 1
                ]);
            }
        }
    }
}