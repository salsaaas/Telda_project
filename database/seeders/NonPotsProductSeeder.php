<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class NonPotsProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // ---------- ASTINET ----------
            $astinet = Category::firstOrCreate(['nama_category' => 'ASTINET']);

            $astinetProducts = [
                ['nama_product' => 'ASTINET 1:1 - (1 Mbps)',   'price' => 143000],
                ['nama_product' => 'ASTINET 1:1 - (2 Mbps)',   'price' => 273000],
                ['nama_product' => 'ASTINET 1:1 - (3 Mbps)',   'price' => 394000],
                ['nama_product' => 'ASTINET 1:1 - (5 Mbps)',   'price' => 615000],
                ['nama_product' => 'ASTINET 1:1 - (10 Mbps)',  'price' => 1013000],
                ['nama_product' => 'ASTINET 1:1 - (20 Mbps)',  'price' => 1963000],
                ['nama_product' => 'ASTINET 1:1 - (30 Mbps)',  'price' => 2582000],
                ['nama_product' => 'ASTINET 1:1 - (40 Mbps)',  'price' => 3201000],
                ['nama_product' => 'ASTINET 1:1 - (50 Mbps)',  'price' => 4570000],
                ['nama_product' => 'ASTINET 1:1 - (60 Mbps)',  'price' => 5045000],
                ['nama_product' => 'ASTINET 1:1 - (70 Mbps)',  'price' => 5520000],
                ['nama_product' => 'ASTINET 1:1 - (80 Mbps)',  'price' => 5995000],
                ['nama_product' => 'ASTINET 1:1 - (90 Mbps)',  'price' => 6470000],
                ['nama_product' => 'ASTINET 1:1 - (100 Mbps)', 'price' => 6945000],
                ['nama_product' => 'ASTINET 1:1 - (150 Mbps)', 'price' => 9856000],
                ['nama_product' => 'ASTINET 1:1 - (200 Mbps)', 'price' => 12767000],
                ['nama_product' => 'ASTINET 1:1 - (250 Mbps)', 'price' => 15240833],
                ['nama_product' => 'ASTINET 1:1 - (300 Mbps)', 'price' => 17714666],
                ['nama_product' => 'ASTINET 1:1 - (350 Mbps)', 'price' => 20188500],
                ['nama_product' => 'ASTINET 1:1 - (400 Mbps)', 'price' => 22662333],
                ['nama_product' => 'ASTINET 1:1 - (450 Mbps)', 'price' => 25136000],
                ['nama_product' => 'ASTINET 1:1 - (500 Mbps)', 'price' => 27610000],
                ['nama_product' => 'ASTINET 1:1 - (550 Mbps)', 'price' => 28924100],
                ['nama_product' => 'ASTINET 1:1 - (600 Mbps)', 'price' => 30238200],
                ['nama_product' => 'ASTINET 1:1 - (650 Mbps)', 'price' => 31552300],
                ['nama_product' => 'ASTINET 1:1 - (700 Mbps)', 'price' => 32866400],
                ['nama_product' => 'ASTINET 1:1 - (750 Mbps)', 'price' => 34180500],
                ['nama_product' => 'ASTINET 1:1 - (800 Mbps)', 'price' => 35494600],
                ['nama_product' => 'ASTINET 1:1 - (850 Mbps)', 'price' => 36808700],
                ['nama_product' => 'ASTINET 1:1 - (900 Mbps)', 'price' => 38122800],
                ['nama_product' => 'ASTINET 1:1 - (950 Mbps)', 'price' => 39436900],
                ['nama_product' => 'ASTINET 1:1 - (1000 Mbps)','price' => 40751000],

                ['nama_product' => 'ASTINET 1:2 - (1 Mbps)',   'price' => 111000],
                ['nama_product' => 'ASTINET 1:2 - (2 Mbps)',   'price' => 215000],
                ['nama_product' => 'ASTINET 1:2 - (3 Mbps)',   'price' => 310000],
                ['nama_product' => 'ASTINET 1:2 - (5 Mbps)',   'price' => 473000],
                ['nama_product' => 'ASTINET 1:2 - (10 Mbps)',  'price' => 637000],
                ['nama_product' => 'ASTINET 1:2 - (20 Mbps)',  'price' => 1234000],
                ['nama_product' => 'ASTINET 1:2 - (30 Mbps)',  'price' => 1780000],
                ['nama_product' => 'ASTINET 1:2 - (40 Mbps)',  'price' => 2283000],
                ['nama_product' => 'ASTINET 1:2 - (50 Mbps)',  'price' => 2740000],
                ['nama_product' => 'ASTINET 1:2 - (60 Mbps)',  'price' => 3902000],
                ['nama_product' => 'ASTINET 1:2 - (70 Mbps)',  'price' => 4269000],
                ['nama_product' => 'ASTINET 1:2 - (80 Mbps)',  'price' => 4598000],
                ['nama_product' => 'ASTINET 1:2 - (90 Mbps)',  'price' => 4741000],
                ['nama_product' => 'ASTINET 1:2 - (100 Mbps)', 'price' => 4876000],

                ['nama_product' => 'ASTINET 1:4 - (1 Mbps)',   'price' => 93000],
                ['nama_product' => 'ASTINET 1:4 - (2 Mbps)',   'price' => 180000],
                ['nama_product' => 'ASTINET 1:4 - (3 Mbps)',   'price' => 260000],
                ['nama_product' => 'ASTINET 1:4 - (5 Mbps)',   'price' => 397000],
                ['nama_product' => 'ASTINET 1:4 - (10 Mbps)',  'price' => 535000],
                ['nama_product' => 'ASTINET 1:4 - (20 Mbps)',  'price' => 1035000],
                ['nama_product' => 'ASTINET 1:4 - (30 Mbps)',  'price' => 1493000],
                ['nama_product' => 'ASTINET 1:4 - (40 Mbps)',  'price' => 1913000],
                ['nama_product' => 'ASTINET 1:4 - (50 Mbps)',  'price' => 2296000],
                ['nama_product' => 'ASTINET 1:4 - (60 Mbps)',  'price' => 3392000],
                ['nama_product' => 'ASTINET 1:4 - (70 Mbps)',  'price' => 3701000],
                ['nama_product' => 'ASTINET 1:4 - (80 Mbps)',  'price' => 3975000],
                ['nama_product' => 'ASTINET 1:4 - (90 Mbps)',  'price' => 4209000],
                ['nama_product' => 'ASTINET 1:4 - (100 Mbps)', 'price' => 4405000],
            ];

            $this->upsertProducts($astinet->category_id, $astinetProducts);

            // ---------- IP TRANSIT ----------
            $ipTransit = Category::firstOrCreate(['nama_category' => 'IP TRANSIT']);

            $ipTransitProducts = [
                ['nama_product' => 'IP TRANSIT MIX - (100 Mbps)',  'price' => 6493000],
                ['nama_product' => 'IP TRANSIT MIX - (150 Mbps)',  'price' => 9173500],
                ['nama_product' => 'IP TRANSIT MIX - (200 Mbps)',  'price' => 11854000],
                ['nama_product' => 'IP TRANSIT MIX - (250 Mbps)',  'price' => 13870000],
                ['nama_product' => 'IP TRANSIT MIX - (300 Mbps)',  'price' => 15886000],
                ['nama_product' => 'IP TRANSIT MIX - (350 Mbps)',  'price' => 17902000],
                ['nama_product' => 'IP TRANSIT MIX - (400 Mbps)',  'price' => 19918000],
                ['nama_product' => 'IP TRANSIT MIX - (450 Mbps)',  'price' => 21934000],
                ['nama_product' => 'IP TRANSIT MIX - (500 Mbps)',  'price' => 23950000],
                ['nama_product' => 'IP TRANSIT MIX - (550 Mbps)',  'price' => 25961500],
                ['nama_product' => 'IP TRANSIT MIX - (600 Mbps)',  'price' => 27973000],
                ['nama_product' => 'IP TRANSIT MIX - (650 Mbps)',  'price' => 29337500],
                ['nama_product' => 'IP TRANSIT MIX - (700 Mbps)',  'price' => 30702000],
                ['nama_product' => 'IP TRANSIT MIX - (750 Mbps)',  'price' => 31826000],
                ['nama_product' => 'IP TRANSIT MIX - (800 Mbps)',  'price' => 32950000],
                ['nama_product' => 'IP TRANSIT MIX - (850 Mbps)',  'price' => 33841000],
                ['nama_product' => 'IP TRANSIT MIX - (900 Mbps)',  'price' => 34732000],
                ['nama_product' => 'IP TRANSIT MIX - (950 Mbps)',  'price' => 35407500],
                ['nama_product' => 'IP TRANSIT MIX - (1000 Mbps)', 'price' => 36083000],

                ['nama_product' => 'IP TRANSIT GLOBAL 100 Mbps',  'price' => 7115000],
                ['nama_product' => 'IP TRANSIT GLOBAL 150 Mbps',  'price' => 10164000],
                ['nama_product' => 'IP TRANSIT GLOBAL 200 Mbps',  'price' => 13213000],
                ['nama_product' => 'IP TRANSIT GLOBAL 250 Mbps',  'price' => 15828833],
                ['nama_product' => 'IP TRANSIT GLOBAL 300 Mbps',  'price' => 18444666],
                ['nama_product' => 'IP TRANSIT GLOBAL 350 Mbps',  'price' => 21060500],
                ['nama_product' => 'IP TRANSIT GLOBAL 400 Mbps',  'price' => 23676333],
                ['nama_product' => 'IP TRANSIT GLOBAL 450 Mbps',  'price' => 26292166],
                ['nama_product' => 'IP TRANSIT GLOBAL 500 Mbps',  'price' => 28908000],
                ['nama_product' => 'IP TRANSIT GLOBAL 550 Mbps',  'price' => 30581000],
                ['nama_product' => 'IP TRANSIT GLOBAL 600 Mbps',  'price' => 32254000],
                ['nama_product' => 'IP TRANSIT GLOBAL 650 Mbps',  'price' => 33826500],
                ['nama_product' => 'IP TRANSIT GLOBAL 700 Mbps',  'price' => 35399000],
                ['nama_product' => 'IP TRANSIT GLOBAL 750 Mbps',  'price' => 36694000],
                ['nama_product' => 'IP TRANSIT GLOBAL 800 Mbps',  'price' => 37989000],
                ['nama_product' => 'IP TRANSIT GLOBAL 850 Mbps',  'price' => 38617000],
                ['nama_product' => 'IP TRANSIT GLOBAL 900 Mbps',  'price' => 39245000],
                ['nama_product' => 'IP TRANSIT GLOBAL 950 Mbps',  'price' => 40008000],
                ['nama_product' => 'IP TRANSIT GLOBAL 1000 Mbps', 'price' => 40771000],

                ['nama_product' => 'IP TRANSIT DOMESTIK - (100 Mbps)',  'price' => 2238000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (150 Mbps)',  'price' => 3061500],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (200 Mbps)',  'price' => 3885000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (250 Mbps)',  'price' => 4618833],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (300 Mbps)',  'price' => 5352666],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (350 Mbps)',  'price' => 6086500],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (400 Mbps)',  'price' => 6820333],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (450 Mbps)',  'price' => 7554166],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (500 Mbps)',  'price' => 8288000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (550 Mbps)',  'price' => 8760500],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (600 Mbps)',  'price' => 9233000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (650 Mbps)',  'price' => 9829000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (700 Mbps)',  'price' => 10425000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (750 Mbps)',  'price' => 10970000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (800 Mbps)',  'price' => 11515000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (850 Mbps)',  'price' => 11887000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (900 Mbps)',  'price' => 12259000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (950 Mbps)',  'price' => 12695000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (1000 Mbps)', 'price' => 13132000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (2000 Mbps)', 'price' => 26289000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (3000 Mbps)', 'price' => 39095000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (4000 Mbps)', 'price' => 51673000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (5000 Mbps)', 'price' => 64021000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (6000 Mbps)', 'price' => 76522000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (7000 Mbps)', 'price' => 88748000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (8000 Mbps)', 'price' => 101395000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (9000 Mbps)', 'price' => 114012000],
                ['nama_product' => 'IP TRANSIT DOMESTIK - (10000 Mbps)','price' => 125544000],
            ];

            $this->upsertProducts($ipTransit->category_id, $ipTransitProducts);

            // ---------- METRO-E ----------
            $metro = Category::firstOrCreate(['nama_category' => 'METRO-E']);

            $metroProducts = [
                // Best Effort P2P/P2MP
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 1 Mbps',   'price' => 517000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 2 Mbps',   'price' => 657000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 3 Mbps',   'price' => 775000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 4 Mbps',   'price' => 893000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 5 Mbps',   'price' => 1011000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 6 Mbps',   'price' => 1044000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 7 Mbps',   'price' => 1100000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 8 Mbps',   'price' => 1151000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 9 Mbps',   'price' => 1246000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 10 Mbps',  'price' => 1342000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 20 Mbps',  'price' => 1845000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 30 Mbps',  'price' => 2361000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 40 Mbps',  'price' => 2866000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 50 Mbps',  'price' => 3236000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 60 Mbps',  'price' => 3443000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 70 Mbps',  'price' => 3656000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 80 Mbps',  'price' => 3864000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 90 Mbps',  'price' => 4071000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 100 Mbps', 'price' => 4290000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 200 Mbps', 'price' => 6084000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 300 Mbps', 'price' => 7402000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 400 Mbps', 'price' => 8585000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 500 Mbps', 'price' => 9767000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 600 Mbps', 'price' => 10950000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 700 Mbps', 'price' => 11943000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 800 Mbps', 'price' => 12879000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 900 Mbps', 'price' => 13815000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 1000 Mbps','price' => 14751000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 2000 Mbps','price' => 28370000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 3000 Mbps','price' => 40967000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 4000 Mbps','price' => 52533000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 5000 Mbps','price' => 63073000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 6000 Mbps','price' => 72594000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 7000 Mbps','price' => 81092000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 8000 Mbps','price' => 88549000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 9000 Mbps','price' => 94996000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Best Effort 10000 Mbps','price' => 100412000],

                // Interaktif P2P/P2MP
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 1 Mbps',   'price' => 615000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 2 Mbps',   'price' => 783000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 3 Mbps',   'price' => 922000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 4 Mbps',   'price' => 1061000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 5 Mbps',   'price' => 1199000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 6 Mbps',   'price' => 1239000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 7 Mbps',   'price' => 1303000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 8 Mbps',   'price' => 1367000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 9 Mbps',   'price' => 1477000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 10 Mbps',  'price' => 1599000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 20 Mbps',  'price' => 2194000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 30 Mbps',  'price' => 2806000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 40 Mbps',  'price' => 3408000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 50 Mbps',  'price' => 3848000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 60 Mbps',  'price' => 4095000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 70 Mbps',  'price' => 4350000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 80 Mbps',  'price' => 4593000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 90 Mbps',  'price' => 4841000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 100 Mbps', 'price' => 5096000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 200 Mbps', 'price' => 7236000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 300 Mbps', 'price' => 8797000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 400 Mbps', 'price' => 10202000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 500 Mbps', 'price' => 11606000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 600 Mbps', 'price' => 13012000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 700 Mbps', 'price' => 14191000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 800 Mbps', 'price' => 15307000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 900 Mbps', 'price' => 16417000],
                ['nama_product' => 'METRO-E EBIS Intra P2P/P2MP Interaktif 1000 Mbps','price' => 17533000],

                // MP2MP Best Effort
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 1 Mbps',  'price' => 665000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 2 Mbps',  'price' => 844000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 3 Mbps',  'price' => 999000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 4 Mbps',  'price' => 1143000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 5 Mbps',  'price' => 1300000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 6 Mbps',  'price' => 1339000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 7 Mbps',  'price' => 1415000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 8 Mbps',  'price' => 1479000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 9 Mbps',  'price' => 1600000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 10 Mbps', 'price' => 1726000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 20 Mbps', 'price' => 2371000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 30 Mbps', 'price' => 3034000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 40 Mbps', 'price' => 3686000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 50 Mbps', 'price' => 4158000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 60 Mbps', 'price' => 4429000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 70 Mbps', 'price' => 4700000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 80 Mbps', 'price' => 4970000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 90 Mbps', 'price' => 5235000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 100 Mbps','price' => 5513000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 200 Mbps','price' => 7825000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 300 Mbps','price' => 9514000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 400 Mbps','price' => 11031000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 500 Mbps','price' => 12551000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 600 Mbps','price' => 14073000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 700 Mbps','price' => 15348000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 800 Mbps','price' => 16552000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 900 Mbps','price' => 17757000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 1000 Mbps','price' => 18962000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 2000 Mbps','price' => 36464000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 3000 Mbps','price' => 52650000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 4000 Mbps','price' => 67517000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 5000 Mbps','price' => 81070000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 6000 Mbps','price' => 93304000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 7000 Mbps','price' => 104221000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 8000 Mbps','price' => 113813000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 9000 Mbps','price' => 122098000],
                ['nama_product' => 'METRO-E EBIS Intra MP2MP Best Effort 10000 Mbps','price' => 129061000],
            ];

            $this->upsertProducts($metro->category_id, $metroProducts);

            // logs (opsional)
            $this->command?->info('ASTINET upserted: ' . count($astinetProducts));
            $this->command?->info('IP TRANSIT upserted: ' . count($ipTransitProducts));
            $this->command?->info('METRO-E upserted: ' . count($metroProducts));
        });
    }

    /**
     * Helper untuk memasukkan / update produk per kategori.
     */
    private function upsertProducts(int $categoryId, array $items): void
    {
        foreach ($items as $i) {
            Product::updateOrCreate(
                ['category_id' => $categoryId, 'nama_product' => $i['nama_product']],
                ['price' => $i['price']]
            );
        }
    }
}
