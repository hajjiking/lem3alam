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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['client', 'tasker', 'admin'])->default('client');
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->json('bio_translations')->nullable(); // For French/Arabic
            $table->string('profile_image')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->json('skills')->nullable(); // For taskers
            $table->decimal('hourly_rate', 8, 2)->nullable(); // For taskers
            $table->boolean('available')->default(true); // For taskers
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'phone', 'bio', 'bio_translations', 'profile_image',
                'city', 'address', 'rating', 'total_reviews', 'status',
                'is_verified', 'verified_at', 'skills', 'hourly_rate', 'available',
            ]);
        });
    }
};
