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
        Schema::table('reviews', function (Blueprint $table) {
            // Check if columns exist before adding them
            if (! Schema::hasColumn('reviews', 'client_id')) {
                $table->unsignedBigInteger('client_id')->after('id');
                $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (! Schema::hasColumn('reviews', 'tasker_id')) {
                $table->unsignedBigInteger('tasker_id')->after('client_id');
                $table->foreign('tasker_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (! Schema::hasColumn('reviews', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('comment_translations');
            }

            if (! Schema::hasColumn('reviews', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('status');
            }

            if (! Schema::hasColumn('reviews', 'approved_by')) {
                $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
                $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            }

            if (! Schema::hasColumn('reviews', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('approved_by');
            }

            if (! Schema::hasColumn('reviews', 'metadata')) {
                $table->json('metadata')->nullable()->comment('Additional review metadata')->after('is_featured');
            }

            // Add indexes for better performance
            if (! Schema::hasIndex('reviews', 'reviews_client_id_index')) {
                $table->index('client_id');
            }

            if (! Schema::hasIndex('reviews', 'reviews_tasker_id_index')) {
                $table->index('tasker_id');
            }

            if (! Schema::hasIndex('reviews', 'reviews_status_index')) {
                $table->index('status');
            }

            if (! Schema::hasIndex('reviews', 'reviews_rating_index')) {
                $table->index('rating');
            }

            if (! Schema::hasIndex('reviews', 'reviews_is_featured_index')) {
                $table->index('is_featured');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['client_id']);
            $table->dropForeign(['tasker_id']);
            $table->dropForeign(['approved_by']);

            // Drop indexes
            $table->dropIndex(['client_id']);
            $table->dropIndex(['tasker_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['rating']);
            $table->dropIndex(['is_featured']);

            // Drop columns
            $table->dropColumn([
                'client_id',
                'tasker_id',
                'status',
                'approved_at',
                'approved_by',
                'is_featured',
                'metadata',
            ]);
        });
    }
};
