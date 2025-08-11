<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;


class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Jalankan seeder POTS
        $this->call(PotsProductSeeder::class);

        // Jalankan seeder NON-POTS
        $this->call(NonPotsProductSeeder::class);
    }
}
