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
        $indibiz = Category::where('nama_category', 'INDIBIZ')->first();
        if (!$indibiz) {
            $indibiz = Category::create(['nama_category' => 'INDIBIZ']);
        }

        $products = [
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '1S - INET ONLY (50 Mbps)',
                'price' => 439000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '1S - INET ONLY (75 Mbps)',
                'price' => 519000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '1S - INET ONLY (100 Mbps)',
                'price' => 669000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '1S - INET ONLY (150 Mbps)',
                'price' => 819000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '1S - INET ONLY (200 Mbps)',
                'price' => 1049000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '1S - INET ONLY (300 Mbps)',
                'price' => 1499000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + VOICE (50 Mbps)',
                'price' => 479000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + VOICE (75 Mbps)',
                'price' => 559000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + VOICE (100 Mbps)',
                'price' => 709000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + VOICE (150 Mbps)',
                'price' => 859000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + VOICE (200 Mbps)',
                'price' => 1089000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + VOICE (300 Mbps)',
                'price' => 1539000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + IPTV (50 Mbps)',
                'price' => 639000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + IPTV (75 Mbps)',
                'price' => 719000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + IPTV (100 Mbps)',
                'price' => 869000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + IPTV (150 Mbps)',
                'price' => 1019000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + IPTV (200 Mbps)',
                'price' => 1249000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + IPTV (300 Mbps)',
                'price' => 1699000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + NETMONK (50 Mbps)',
                'price' => 465000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + NETMONK (75 Mbps)',
                'price' => 545000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + NETMONK (100 Mbps)',
                'price' => 695000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + NETMONK (150 Mbps)',
                'price' => 845000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + NETMONK (200 Mbps)',
                'price' => 1075000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + NETMONK (300 Mbps)',
                'price' => 1559000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + OCA (50 Mbps)',
                'price' => 543000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + OCA (75 Mbps)',
                'price' => 623000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + OCA (100 Mbps)',
                'price' => 773000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + OCA (150 Mbps)',
                'price' => 923000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + OCA (200 Mbps)',
                'price' => 1153000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + OCA (300 Mbps)',
                'price' => 1603000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + PIJAR (50 Mbps)',
                'price' => 1022000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + PIJAR (75 Mbps)',
                'price' => 1102000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + PIJAR (100 Mbps)',
                'price' => 1252000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + PIJAR (150 Mbps)',
                'price' => 1402000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + PIJAR (200 Mbps)',
                'price' => 1632000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '2S - INET + PIJAR (300 Mbps)',
                'price' => 2082000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + TELP & IPTV (50 Mbps)',
                'price' => 664000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + TELP & IPTV (75 Mbps)',
                'price' => 744000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + TELP & IPTV (100 Mbps)',
                'price' => 894000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + TELP & IPTV (150 Mbps)',
                'price' => 1044000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + TELP & IPTV (200 Mbps)',
                'price' => 1274000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + TELP & IPTV (300 Mbps)',
                'price' => 1724000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & NETMONK (50 Mbps)',
                'price' => 506000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & NETMONK (75 Mbps)',
                'price' => 586000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & NETMONK (100 Mbps)',
                'price' => 736000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & NETMONK (150 Mbps)',
                'price' => 886000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & NETMONK (200 Mbps)',
                'price' => 1116000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & NETMONK (300 Mbps)',
                'price' => 1566000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & OCA (50 Mbps)',
                'price' => 582950
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & OCA (75 Mbps)',
                'price' => 662950
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & OCA (100 Mbps)',
                'price' => 812950
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & OCA (150 Mbps)',
                'price' => 962950
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & OCA (200 Mbps)',
                'price' => 1192950
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & OCA (300 Mbps)',
                'price' => 1642950
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & PIJAR (50 Mbps)',
                'price' => 1034000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & PIJAR (75 Mbps)',
                'price' => 1114000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & PIJAR (100 Mbps)',
                'price' => 1264000
            ],
            [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & PIJAR (150 Mbps)',
                'price' => 1414000
            ],
             [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & PIJAR (200 Mbps)',
                'price' => 1644000
            ],
             [
                'category_id' => $indibiz->category_id,
                'nama_product' => '3S - INET + VOICE & PIJAR (300 Mbps)',
                'price' => 2094000
            ],
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