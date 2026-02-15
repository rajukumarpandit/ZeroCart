<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            'Color',
            'Size',
            'RAM',
            'Storage',
            'Material',
            'Weight',
        ];

        foreach ($attributes as $attr) {
            Attribute::firstOrCreate([
                'slug' => Str::slug($attr)
            ], [
                'name' => $attr,
                'status' => 1
            ]);
        }
    }
}