<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama_category' => 'ASTINET'],
            ['nama_category' => 'IP TRANSIT'],
            ['nama_category' => 'METRO-E'],

             ['nama_category' => 'INDIBIZ'], 
            ['nama_category' => 'ADDON'], 
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}