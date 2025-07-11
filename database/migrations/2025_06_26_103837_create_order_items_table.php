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
        Schema::create("order_items", function (Blueprint $table) {
            $table->id();
            $table->string("product_name");
            $table->string("sku")->unique();
            $table->integer("quantity");
            $table->decimal("unit_price");
            $table->decimal("subtotal");
            $table->decimal("total");
            $table->foreignId("order_id");
            $table->foreignId("product_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("order_items");
    }
};
