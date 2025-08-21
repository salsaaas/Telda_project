<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPotsSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['nama_category' => 'INDIBIZ'],
            ['nama_category' => 'ADDON'],
            // tambah kalau perlu
        ];

        foreach ($rows as $r) {
            DB::table('categorypots')->updateOrInsert(
                ['nama_category' => $r['nama_category']],
                $r
            );
        }
    }
}
