<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// (opsional) import eksplisit supaya IDE gampang auto-complete
use Database\Seeders\CategorySeeder;
use Database\Seeders\CategoryPotsSeeder;
use Database\Seeders\NonPotsProductSeeder;
use Database\Seeders\PotsProductSeeder;
use Database\Seeders\OTCSeeder;
// use Database\Seeders\ProductSeeder; // pakai ini HANYA jika NonPotsProductSeeder tidak dipakai

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // (Opsional) seed user contoh — comment kalau tidak ada factory User
        // \App\Models\User::factory()->create([
        //     'name'  => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // 1) master kategori
            CategorySeeder::class,        // tabel: categories
            CategoryPotsSeeder::class,    // tabel: categorypots

            // 2) produk
            NonPotsProductSeeder::class,  // tabel: products  (pilih salah satu dengan ProductSeeder)
            // ProductSeeder::class,       // <-- gunakan ini kalau NonPotsProductSeeder tidak digunakan
            PotsProductSeeder::class,     // tabel: productpots

            // 3) data lain yang bergantung pada produk (OTC/pivot)
            OTCSeeder::class,
        ]);
    }
}
