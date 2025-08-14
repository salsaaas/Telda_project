<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            // FK ke categories.category_id
            $table->unsignedBigInteger('category_id');

            $table->string('nama_product');
            $table->decimal('price', 15, 2); // pakai unsignedBigInteger kalau selalu bulat

            $table->timestamps();

            // Hindari duplikat product dalam kategori yang sama
            $table->unique(['category_id', 'nama_product']);

            // Foreign key
            $table->foreign('category_id')
                  ->references('category_id')->on('categories')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete(); // ganti ke ->cascadeOnDelete() jika ingin ikut terhapus
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
