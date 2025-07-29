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