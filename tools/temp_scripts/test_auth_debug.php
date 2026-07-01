<?php

require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::capture();

$response = $kernel->handle($request);

// Now we can use Laravel's session and auth
echo '<h2>Laravel Authentication Debug</h2>';

// Check if user is authenticated
if (Auth::check()) {
    $user = Auth::user();
    echo "<p style='color: green;'>✓ User is authenticated</p>";
    echo '<p>User ID: '.$user->id.'</p>';
    echo '<p>User Email: '.$user->email.'</p>';
    echo '<p>User Role: '.$user->role.'</p>';

    // Check if user has client role
    if ($user->role === 'client') {
        echo "<p style='color: green;'>✓ User has 'client' role</p>";
    } else {
        echo "<p style='color: red;'>✗ User does NOT have 'client' role (has: ".$user->role.')</p>';
    }
} else {
    echo "<p style='color: red;'>✗ User is NOT authenticated</p>";
}

// Check session
echo '<h3>Session Information:</h3>';
echo '<p>Session ID: '.session()->getId().'</p>';
echo '<p>Session Driver: '.config('session.driver').'</p>';

// Check CSRF token
try {
    $token = csrf_token();
    echo "<p style='color: green;'>✓ CSRF Token: ".$token.'</p>';
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ CSRF Token Error: ".$e->getMessage().'</p>';
}

// Test links
echo '<h3>Test Links:</h3>';
echo "<p><a href='/login'>Login Page</a></p>";
echo "<p><a href='/ar/tasks/create'>Task Creation Page (Arabic)</a></p>";
echo "<p><a href='/tasks/create'>Task Creation Page (English)</a></p>";

$kernel->terminate($request, $response);
