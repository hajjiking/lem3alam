<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=== Task Creation Test ===\n\n";

// 1. Find test user
$user = User::where('email', 'client@test.com')->first();
if (! $user) {
    echo "❌ Test user not found!\n";
    exit(1);
}

echo "✅ Test user found: {$user->name} (ID: {$user->id}, Role: {$user->role})\n";

// 2. Check categories
$categoryCount = Category::count();
echo "✅ Categories available: {$categoryCount}\n";

if ($categoryCount == 0) {
    echo "❌ No categories found! Creating a test category...\n";
    $category = new Category;
    $category->name = 'Test Category';
    $category->save();
    echo "✅ Test category created with ID: {$category->id}\n";
} else {
    $category = Category::first();
    echo "✅ Using category: {$category->name} (ID: {$category->id})\n";
}

// 3. Simulate authentication
Auth::login($user);
echo '✅ User authenticated: '.(Auth::check() ? 'Yes' : 'No')."\n";
echo '✅ Authenticated user ID: '.Auth::id()."\n";

// 4. Test task creation
try {
    $task = new Task;
    $task->title = 'Test Task Creation';
    $task->description = 'This is a test task to verify the creation process works correctly.';
    $task->client_id = Auth::id();
    $task->category_id = $category->id;
    $task->budget_min = 100.00;
    $task->budget_max = 200.00;
    $task->budget_type = 'fixed';
    $task->location = 'Test Location';
    $task->urgency = 'medium';
    $task->is_remote = false;

    $task->save();

    echo "✅ Task created successfully!\n";
    echo "   - Task ID: {$task->id}\n";
    echo "   - Title: {$task->title}\n";
    echo "   - Client ID: {$task->client_id}\n";
    echo "   - Category ID: {$task->category_id}\n";
    echo "   - Budget: {$task->budget_min} - {$task->budget_max} ({$task->budget_type})\n";
    echo "   - Status: {$task->status}\n";

} catch (Exception $e) {
    echo '❌ Task creation failed: '.$e->getMessage()."\n";
    echo '   Stack trace: '.$e->getTraceAsString()."\n";
}

echo "\n=== Test Complete ===\n";
