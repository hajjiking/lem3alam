<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        foreach ([
            ['key' => 'manage_users', 'label' => 'Manage users', 'group' => 'users'],
            ['key' => 'manage_workers', 'label' => 'Manage workers', 'group' => 'users'],
            ['key' => 'manage_tasks', 'label' => 'Manage tasks', 'group' => 'tasks'],
            ['key' => 'manage_categories', 'label' => 'Manage categories', 'group' => 'catalog'],
            ['key' => 'manage_reports', 'label' => 'Manage reports', 'group' => 'support'],
            ['key' => 'manage_reviews', 'label' => 'Manage reviews', 'group' => 'quality'],
            ['key' => 'manage_notifications', 'label' => 'Manage notifications', 'group' => 'communications'],
            ['key' => 'manage_payments', 'label' => 'Manage payments', 'group' => 'finance'],
            ['key' => 'manage_disputes', 'label' => 'Manage disputes', 'group' => 'support'],
            ['key' => 'manage_content', 'label' => 'Manage content', 'group' => 'content'],
            ['key' => 'manage_settings', 'label' => 'Manage settings', 'group' => 'settings'],
            ['key' => 'view_analytics', 'label' => 'View analytics', 'group' => 'analytics'],
            ['key' => 'view_audit_logs', 'label' => 'View audit logs', 'group' => 'security'],
        ] as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['key' => $permission['key']],
                [
                    'label' => $permission['label'],
                    'group' => $permission['group'],
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }

    public function down(): void
    {
        DB::table('permissions')->whereIn('key', [
            'manage_users',
            'manage_workers',
            'manage_tasks',
            'manage_categories',
            'manage_reports',
            'manage_reviews',
            'manage_notifications',
            'manage_payments',
            'manage_disputes',
            'manage_content',
            'manage_settings',
            'view_analytics',
            'view_audit_logs',
        ])->delete();
    }
};

