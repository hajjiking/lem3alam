<?php

require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Category;
use App\Models\Task;
use App\Models\User;

try {
    $client = User::where('role', 'client')->first();
    if (! $client) {
        echo "No client user found.\n";
        exit(1);
    }
    $category = Category::first();
    if (! $category) {
        echo "No category found.\n";
        exit(1);
    }

    $data = [
        'title' => 'Debug Task',
        'description' => 'Created via debug script',
        'client_id' => $client->id,
        'category_id' => $category->id,
        'budget_min' => 100,
        'budget_max' => 150,
        'budget_type' => 'fixed',
        'status' => 'open',
        'urgency' => 'urgent',
        'deadline' => now()->addDays(7),
        'required_skills' => ['php', 'laravel'],
        'images' => [],
        'is_remote' => true,
        'applications_count' => 0,
        'location' => null,
    ];

    $task = Task::create($data);
    echo "Task created with ID: {$task->id}\n";
} catch (\Throwable $e) {
    echo 'Exception: '.$e->getMessage()."\n";
}
