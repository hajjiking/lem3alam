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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('payer_id'); // Client
            $table->unsignedBigInteger('payee_id'); // Tasker
            $table->decimal('amount', 10, 2);
            $table->decimal('platform_fee', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2); // Amount after platform fee
            $table->string('currency', 3)->default('MAD'); // Moroccan Dirham
            $table->enum('method', ['cash', 'bank_transfer', 'mobile_money', 'credit_card'])->default('cash');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'disputed'])->default('pending');
            $table->string('transaction_id')->nullable(); // External payment gateway ID
            $table->json('payment_details')->nullable(); // Gateway-specific data
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('released_at')->nullable(); // When payment is released to tasker
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('payer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payee_id')->references('id')->on('users')->onDelete('cascade');

            $table->index(['task_id', 'status']);
            $table->index(['payer_id', 'status']);
            $table->index(['payee_id', 'status']);
            $table->unique('transaction_id');
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
