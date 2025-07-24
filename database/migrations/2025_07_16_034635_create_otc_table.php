<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('otc', function (Blueprint $table) {
            $table->id('id_OTC');
            $table->string('category_OTC');
            $table->decimal('price_OTC', 12, 2);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('otc');
    }
};