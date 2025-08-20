<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Carbon;

class CategorypotsSeeder extends Seeder   // <--- ganti sesuai perintah artisan
{
    public function run(): void
    {
        $now = Carbon::now();

        Category::firstOrCreate(['nama_category' => 'INDIBIZ']);
        Category::firstOrCreate(['nama_category' => 'ADD ON']);

        // update timestamp biar rapi
        Category::where('nama_category', 'ADD ON')
                ->update(['updated_at' => $now]);
    }
}
