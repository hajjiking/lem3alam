<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->string('transport');
            $table->string('status');
            $table->unsignedInteger('attempts')->default(0);
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->index(['message_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_deliveries');
    }
};
