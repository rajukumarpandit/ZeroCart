<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxSeeder extends Seeder
{
    public function run(): void
    {
        $taxes = [
            [
                'name' => 'No Tax',
                'rate' => 0.00,
                'type' => 'exclusive',
                'applies_to' => 'product',
                'is_default' => true,
                'status' => true,
            ],
            [
                'name' => 'GST 5%',
                'rate' => 5.00,
                'type' => 'exclusive',
                'applies_to' => 'product',
                'is_default' => false,
                'status' => true,
            ],
            [
                'name' => 'GST 12%',
                'rate' => 12.00,
                'type' => 'exclusive',
                'applies_to' => 'product',
                'is_default' => false,
                'status' => true,
            ],
            [
                'name' => 'GST 18%',
                'rate' => 18.00,
                'type' => 'exclusive',
                'applies_to' => 'product',
                'is_default' => false,
                'status' => true,
            ],
            [
                'name' => 'GST 28%',
                'rate' => 28.00,
                'type' => 'exclusive',
                'applies_to' => 'product',
                'is_default' => false,
                'status' => true,
            ],
        ];

        foreach ($taxes as $tax) {
            Tax::updateOrCreate(
                ['name' => $tax['name']],
                $tax
            );
        }
    }
}