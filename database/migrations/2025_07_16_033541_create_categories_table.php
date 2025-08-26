<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            // Primary key: bigint unsigned AUTO_INCREMENT dengan nama category_id
            $table->bigIncrements('category_id');

            // Nama kategori unik (contoh nilai: INDIBIZ, ADD ON)
            $table->string('nama_category', 100)->unique();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
