<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $astinet = Category::where('nama_category', 'ASTINET')->first();
        if (!$astinet) {
            $astinet = Category::create(['nama_category' => 'ASTINET']);
        }

        $products = [
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (1 Mbps)', 'price' => 143000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (2 Mbps)', 'price' => 273000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (3 Mbps)', 'price' => 394000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (5 Mbps)', 'price' => 615000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (10 Mbps)', 'price' => 1013000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (20 Mbps)', 'price' => 1963000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (30 Mbps)', 'price' => 2582000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (40 Mbps)', 'price' => 3201000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (50 Mbps)', 'price' => 4570000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (60 Mbps)', 'price' => 5045000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (70 Mbps)', 'price' => 5520000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (80 Mbps)', 'price' => 5995000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (90 Mbps)', 'price' => 6470000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (100 Mbps)', 'price' => 6945000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (150 Mbps)', 'price' => 9856000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (200 Mbps)', 'price' => 12767000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (250 Mbps)', 'price' => 15240833],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (300 Mbps)', 'price' => 17714666],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (350 Mbps)', 'price' => 20188500],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (400 Mbps)', 'price' => 22662333],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (450 Mbps)', 'price' => 25136000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (500 Mbps)', 'price' => 27610000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (550 Mbps)', 'price' => 28924100],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (600 Mbps)', 'price' => 30238200],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (650 Mbps)', 'price' => 31552300],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (700 Mbps)', 'price' => 32866400],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (750 Mbps)', 'price' => 34180500],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (800 Mbps)', 'price' => 35494600],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (850 Mbps)', 'price' => 36808700],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (900 Mbps)', 'price' => 38122800],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (950 Mbps)', 'price' => 39436900],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:1 - (1000 Mbps)', 'price' => 40751000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (1 Mbps)', 'price' => 111000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (2 Mbps)', 'price' => 215000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (3 Mbps)', 'price' => 310000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (5 Mbps)', 'price' => 473000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (10 Mbps)', 'price' => 637000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (20 Mbps)', 'price' => 1234000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (30 Mbps)', 'price' => 1780000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (40 Mbps)', 'price' => 2283000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (50 Mbps)', 'price' => 2740000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (60 Mbps)', 'price' => 3902000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (70 Mbps)', 'price' => 4269000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (80 Mbps)', 'price' => 4598000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (90 Mbps)', 'price' => 4741000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:2 - (100 Mbps)', 'price' => 4876000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (1 Mbps)', 'price' => 93000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (2 Mbps)', 'price' => 180000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (3 Mbps)', 'price' => 260000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (5 Mbps)', 'price' => 397000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (10 Mbps)', 'price' => 535000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (20 Mbps)', 'price' => 1035000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (30 Mbps)', 'price' => 1493000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (40 Mbps)', 'price' => 1913000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (50 Mbps)', 'price' => 2296000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (60 Mbps)', 'price' => 3392000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (70 Mbps)', 'price' => 3701000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (80 Mbps)', 'price' => 3975000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (90 Mbps)', 'price' => 4209000],
                ['category_id' => $astinet->category_id, 'nama_product' => 'ASTINET 1:4 - (100 Mbps)', 'price' => 4405000],


        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $addon = Category::where('nama_category', 'ADDON')->first();
        if (!$addon) {
            $addon = Category::create(['nama_category' => 'ADDON']);
        }

        $products = [
            [
                'category_id' => $addon->category_id,
                'nama_product' => 'NETMONK',
                'price' => 60000
            ],
            [
                'category_id' => $addon->category_id,
                'nama_product' => 'OCA',
                'price' => 103950
            ],
            [
                'category_id' => $addon->category_id,
                'nama_product' => 'MESH WIFI',
                'price' => 29000
            ],
            [
                'category_id' => $addon->category_id,
                'nama_product' => 'TOMPS',
                'price' => 50000
            ],
            [
                'category_id' => $addon->category_id,
                'nama_product' => 'PIJAR',
                'price' => 555000
            ],
            [
                'category_id' => $addon->category_id,
                'nama_product' => 'VOICE',
                'price' => 40000
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}