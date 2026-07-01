<?php

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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('task_id');
            $table->decimal('task_amount', 10, 2); // Original task amount
            $table->decimal('commission_rate', 5, 2); // Percentage (e.g., 10.00 for 10%)
            $table->decimal('commission_amount', 10, 2); // Calculated commission
            $table->enum('type', ['platform_fee', 'payment_processing', 'premium_service'])->default('platform_fee');
            $table->enum('status', ['pending', 'collected', 'refunded'])->default('pending');
            $table->text('description')->nullable();
            $table->timestamp('collected_at')->nullable();
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

            $table->index(['status', 'type']);
            $table->index(['task_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
