<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Test different routes
$routes = [
    '/en/tasks/1',
    '/ar/tasks/1',
    '/fr/tasks/1',
    '/en/tasks',
    '/tasks/1',
    '/',
];

// Also test with different task IDs
$task_routes = [
    '/en/tasks/1',
    '/en/tasks/2',
];

foreach ($routes as $route) {
    echo "\nTesting route: $route\n";
    $request = Illuminate\Http\Request::create($route, 'GET');
    $response = $kernel->handle($request);
    echo 'Status Code: '.$response->getStatusCode()."\n";

    if ($response->getStatusCode() === 404) {
        echo "404 - Route not found\n";
    } else {
        echo "Success - Route found\n";
    }
    $kernel->terminate($request, $response);
}

echo "\n--- Testing Task ID Routes ---\n";
foreach ($task_routes as $route) {
    echo "\nTesting task route: $route\n";
    $request = Illuminate\Http\Request::create($route, 'GET');
    $response = $kernel->handle($request);
    echo 'Status Code: '.$response->getStatusCode()."\n";

    if ($response->getStatusCode() === 404) {
        echo "404 - Route not found\n";
    } elseif ($response->getStatusCode() === 200) {
        echo "Success - Task page loaded\n";
    } else {
        echo 'Other status: '.$response->getStatusCode()."\n";
    }
    $kernel->terminate($request, $response);
}

// Check if task exists in database
echo "\n--- Database Check ---\n";
try {
    $task = \App\Models\Task::find(1);
    if ($task) {
        echo "Task 1 exists: {$task->title}\n";
    } else {
        echo "Task 1 does not exist in database\n";
    }
} catch (Exception $e) {
    echo 'Database error: '.$e->getMessage()."\n";
}

$kernel->terminate($request, $response);
