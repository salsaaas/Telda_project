<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('productpots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('nama_product');
            $table->unsignedBigInteger('price')->default(0);
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('category_id')->on('categorypots')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('productpots');
    }
};