<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OTC;

class OTCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $otcs = [
            [
                'category_OTC' => 'FREE/MO',
                'price_OTC' => 0
            ],
            [
                'category_OTC' => 'AO DISCOUNT',
                'price_OTC' => 150000
            ],
            [
                'category_OTC' => 'AO NORMAL',
                'price_OTC' => 500000
            ],
        ];

        foreach ($otcs as $otc) {
            OTC::create($otc);
        }
    }
}
