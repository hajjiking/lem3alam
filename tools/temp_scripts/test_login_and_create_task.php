<?php

require_once 'vendor/autoload.php';

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Request::capture();
$response = $kernel->handle($request);

echo "=== Login and Task Creation Test ===\n\n";

// Test login with the client credentials
$email = 'client@test.com';
$password = 'password123';

echo "🔐 Testing login with: $email\n";

// Find the user
$user = User::where('email', $email)->first();

if (! $user) {
    echo "❌ User not found!\n";
    exit(1);
}

echo "✅ User found: {$user->name} (ID: {$user->id}, Role: {$user->role})\n";

// Verify password
if (! Hash::check($password, $user->password)) {
    echo "❌ Password verification failed!\n";
    exit(1);
}

echo "✅ Password verified successfully\n";

// Simulate login
Auth::login($user);

if (Auth::check()) {
    echo "✅ User logged in successfully\n";
    echo '   - Authenticated user: '.Auth::user()->name."\n";
    echo '   - User ID: '.Auth::user()->id."\n";
    echo '   - User role: '.Auth::user()->role."\n";
} else {
    echo "❌ Login failed\n";
    exit(1);
}

// Check if user has client role
if (Auth::user()->role !== 'client') {
    echo "❌ User does not have 'client' role. Current role: ".Auth::user()->role."\n";
    exit(1);
}

echo "✅ User has correct 'client' role\n";

// Get available categories
$categories = Category::all();
echo '✅ Categories available: '.$categories->count()."\n";

if ($categories->count() == 0) {
    echo "❌ No categories found!\n";
    exit(1);
}

$category = $categories->first();
echo "✅ Using category: {$category->name} (ID: {$category->id})\n";

// Create a test task
echo "\n📝 Creating test task...\n";

try {
    $task = new Task;
    $task->title = 'Test Task via Login Script';
    $task->description = 'This is a test task created after successful login authentication.';
    $task->category_id = $category->id;
    $task->client_id = Auth::user()->id;
    $task->budget_min = 150.00;
    $task->budget_max = 300.00;
    $task->budget_type = 'fixed';
    $task->location = 'Test Location';
    $task->deadline = now()->addDays(7);
    $task->status = 'open';

    $task->save();

    echo "✅ Task created successfully!\n";
    echo "   - Task ID: {$task->id}\n";
    echo "   - Title: {$task->title}\n";
    echo "   - Client ID: {$task->client_id}\n";
    echo "   - Category ID: {$task->category_id}\n";
    echo "   - Budget: {$task->budget_min} - {$task->budget_max} ({$task->budget_type})\n";
    echo "   - Status: {$task->status}\n";
    echo "   - Created at: {$task->created_at}\n";

} catch (Exception $e) {
    echo '❌ Task creation failed: '.$e->getMessage()."\n";
    echo "Stack trace:\n".$e->getTraceAsString()."\n";
    exit(1);
}

echo "\n=== Test Complete - All functionality working! ===\n";
echo "\nTo use the web interface:\n";
echo "1. Go to: http://127.0.0.1:8000/ar/login\n";
echo "2. Login with: $email / $password\n";
echo "3. Navigate to: http://127.0.0.1:8000/ar/tasks/create\n";
echo "4. Fill out and submit the task creation form\n";
