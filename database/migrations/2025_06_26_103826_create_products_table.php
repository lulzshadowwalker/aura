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
        Schema::create("products", function (Blueprint $table) {
            $table->id();
            $table->json("name");
            $table->decimal("price");
            $table->decimal("sale_price")->nullable();
            $table->string("slug")->unique();
            $table->string("sku")->unique();
            $table->json("description");
            $table->boolean("is_active");
            $table->foreignId("category_id")->constrained("categories");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("products");
    }
};
