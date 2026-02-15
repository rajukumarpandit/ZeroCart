<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $adminid=1;
        DB::table('brands')->truncate(); // optional (dev only)

        $brands = [
            'Nike',
            'Adidas',
            'Puma',
            'Reebok',
            'Apple',
            'Samsung',
            'Sony',
            'LG',
            'HP',
            'Dell'
        ];

        foreach ($brands as $name) {
            Brand::create([
                'name'       => $name,
                'slug'       => Str::slug($name),
                'status'     => 1,
                'is_featured'   => rand(0, 1),
                'created_by' => $adminid, // admin id
            ]);
        }
    }
}