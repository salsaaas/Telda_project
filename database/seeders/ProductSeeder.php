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

        $ip_transit = Category::where('nama_category', 'IP TRANSIT')->first();
            if (!$ip_transit) {
                $ip_transit = Category::create(['nama_category' => 'IP TRANSIT']);
            }
        
        $products = [
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (100 Mbps)', 'price' => 6493000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (150 Mbps)', 'price' => 9173500],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (200 Mbps)', 'price' => 11854000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (250 Mbps)', 'price' => 13870000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (300 Mbps)', 'price' => 15886000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (350 Mbps)', 'price' => 17902000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (400 Mbps)', 'price' => 19918000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (450 Mbps)', 'price' => 21934000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (500 Mbps)', 'price' => 23950000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (550 Mbps)', 'price' => 25961500],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (600 Mbps)', 'price' => 27973000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (650 Mbps)', 'price' => 29337500],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (700 Mbps)', 'price' => 30702000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (750 Mbps)', 'price' => 31826000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (800 Mbps)', 'price' => 32950000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (850 Mbps)', 'price' => 33841000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (900 Mbps)', 'price' => 34732000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (950 Mbps)', 'price' => 35407500],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT MIX - (1000 Mbps)', 'price' => 36083000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 100 Mbps', 'price' => 7115000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 150 Mbps', 'price' => 10164000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 200 Mbps', 'price' => 13213000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 250 Mbps', 'price' => 15828833],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 300 Mbps', 'price' => 18444666],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 350 Mbps', 'price' => 21060500],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 400 Mbps', 'price' => 23676333],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 450 Mbps', 'price' => 26292166],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 500 Mbps', 'price' => 28908000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 550 Mbps', 'price' => 30581000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 600 Mbps', 'price' => 32254000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 650 Mbps', 'price' => 33826500],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 700 Mbps', 'price' => 35399000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 750 Mbps', 'price' => 36694000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 800 Mbps', 'price' => 37989000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 850 Mbps', 'price' => 38617000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 900 Mbps', 'price' => 39245000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 950 Mbps', 'price' => 40008000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT GLOBAL 1000 Mbps', 'price' => 40771000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (100 Mbps)', 'price' => 2238000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (150 Mbps)', 'price' => 3061500],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (200 Mbps)', 'price' => 3885000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (250 Mbps)', 'price' => 4618833],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (300 Mbps)', 'price' => 5352666],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (350 Mbps)', 'price' => 6086500],                    
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (400 Mbps)', 'price' => 6820333],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (450 Mbps)', 'price' => 7554166],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (500 Mbps)', 'price' => 8288000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (550 Mbps)', 'price' => 8760500],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (600 Mbps)', 'price' => 9233000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (650 Mbps)', 'price' => 9829000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (700 Mbps)', 'price' => 10425000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (750 Mbps)', 'price' => 10970000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (800 Mbps)', 'price' => 11515000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (850 Mbps)', 'price' => 11887000],                   
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (900 Mbps)', 'price' => 12259000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (950 Mbps)', 'price' => 12695000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (1000 Mbps)', 'price' => 13132000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (2000 Mbps)', 'price' => 26289000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (3000 Mbps)', 'price' => 39095000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (4000 Mbps)', 'price' => 51673000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (5000 Mbps)', 'price' => 64021000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (6000 Mbps)', 'price' => 76522000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (7000 Mbps)', 'price' => 88748000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (8000 Mbps)', 'price' => 101395000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (9000 Mbps)', 'price' => 114012000],
                ['category_id' => $ip_transit->category_id, 'nama_product' => 'IP TRANSIT DOMESTIK - (10000 Mbps)', 'price' => 125544000],
                
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