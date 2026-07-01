<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Check if user already exists
$existingUser = User::where('email', 'client@test.com')->first();

if ($existingUser) {
    echo 'Test client user already exists with ID: '.$existingUser->id."\n";
    echo 'Email: '.$existingUser->email."\n";
    echo 'Role: '.$existingUser->role."\n";
} else {
    // Create new test client user
    $user = new User;
    $user->name = 'Test Client';
    $user->email = 'client@test.com';
    $user->password = Hash::make('password123');
    $user->role = 'client';
    $user->save();

    echo "Test client user created successfully!\n";
    echo 'ID: '.$user->id."\n";
    echo 'Email: '.$user->email."\n";
    echo 'Role: '.$user->role."\n";
    echo "Password: password123\n";
}
