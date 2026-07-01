<?php

// Simple test to check authentication status
session_start();

echo '<h1>Authentication Status Test</h1>';
echo '<p>Session ID: '.session_id().'</p>';
echo '<p>Session Data:</p>';
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

echo '<p>Cookies:</p>';
echo '<pre>';
print_r($_COOKIE);
echo '</pre>';

// Check if Laravel session exists
$laravel_session = null;
foreach ($_COOKIE as $name => $value) {
    if (strpos($name, 'laravel_session') !== false || strpos($name, 'm3alam_session') !== false) {
        $laravel_session = $value;
        echo "<p>Laravel Session Cookie: $name = $value</p>";
    }
}

if (! $laravel_session) {
    echo "<p style='color: red;'>No Laravel session cookie found!</p>";
    echo '<p>This might indicate that the user is not properly logged in.</p>';
} else {
    echo "<p style='color: green;'>Laravel session cookie found.</p>";
}

echo '<hr>';
echo '<h2>Test Links</h2>';
echo "<a href='http://127.0.0.1:8000/ar/login'>Login Page</a><br>";
echo "<a href='http://127.0.0.1:8000/ar/tasks/create'>Task Creation Page</a><br>";
echo "<a href='http://127.0.0.1:8000/ar/tasks'>Tasks Index</a><br>";
