<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $adminId = 1; // super admin user id

        $categories = [
            'Electronics' => [
                'Mobile Phones',
                'Laptops',
                'Televisions',
                'Cameras',
            ],
            'Fashion' => [
                'Men',
                'Women',
                'Kids',
            ],
            'Home & Kitchen' => [
                'Furniture',
                'Kitchen Appliances',
                'Decor',
            ],
            'Books' => [],
        ];

        foreach ($categories as $parent => $children) {

            $parentCategory = Category::create([
                'name'       => $parent,
                'slug'       => Str::slug($parent),
                'parent_id'  => null,
                'status'     => 1,
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ]);

            foreach ($children as $child) {
                Category::create([
                    'name'       => $child,
                    'slug'       => Str::slug($child),
                    'parent_id'  => $parentCategory->id,
                    'status'     => 1,
                    'created_by' => $adminId,
                    'updated_by' => $adminId,
                ]);
            }
        }
    }
}