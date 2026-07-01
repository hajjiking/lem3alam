<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (! Schema::hasColumn('reviews', 'tasker_id')) {
                $table->unsignedBigInteger('tasker_id')->nullable()->index();
            }
            if (! Schema::hasColumn('reviews', 'reviewee_id')) {
                $table->unsignedBigInteger('reviewee_id')->nullable()->index();
            }
            if (! Schema::hasColumn('reviews', 'reviewer_id')) {
                $table->unsignedBigInteger('reviewer_id')->nullable()->index();
            }
            if (! Schema::hasColumn('reviews', 'client_id')) {
                $table->unsignedBigInteger('client_id')->nullable()->index();
            }
            if (! Schema::hasColumn('reviews', 'task_id')) {
                $table->unsignedBigInteger('task_id')->nullable()->index();
            }
            if (! Schema::hasColumn('reviews', 'status')) {
                $table->string('status')->default('pending')->index();
            }
            if (! Schema::hasColumn('reviews', 'type')) {
                $table->string('type')->nullable()->index();
            }
            $table->index(['tasker_id', 'status', 'created_at'], 'reviews_tasker_status_created_idx');
            $table->index(['reviewee_id', 'status', 'created_at'], 'reviews_reviewee_status_created_idx');
            $table->unique(['client_id', 'task_id'], 'reviews_unique_client_task');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex('reviews_tasker_status_created_idx');
            $table->dropIndex('reviews_reviewee_status_created_idx');
            $table->dropUnique('reviews_unique_client_task');
        });
    }
};
