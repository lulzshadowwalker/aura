<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("product_variants", function (Blueprint $table) {
            $table->id();
            $table->json("name");
            $table->string("sku")->unique();
            $table->decimal("price");
            $table->decimal("sale_price")->nullable();
            $table->integer("volume_ml");
            $table->foreignId("product_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("product_variants");
    }
};
