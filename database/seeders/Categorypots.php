<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorypotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama_category' => 'INDIBIZ'],
            ['nama_category' => 'ADDON'],
        ];
        foreach ($categories as $category) {
            Categorypots::create($category);
        }
    }
}