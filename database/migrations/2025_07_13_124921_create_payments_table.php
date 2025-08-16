<?php

use App\Enums\PaymentGateway;
use App\Enums\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->morphs('payable');
            $table->string('external_reference')->unique();
            $table->enum('status', PaymentStatus::values());
            $table->enum('gateway', PaymentGateway::values());
            $table->json('details')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('currency');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
