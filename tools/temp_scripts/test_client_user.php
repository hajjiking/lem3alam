<?php

require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get a client user for testing
$user = \App\Models\User::where('role', 'client')->first();

if ($user) {
    echo "Client user found:\n";
    echo 'Email: '.$user->email."\n";
    echo 'Name: '.$user->name."\n";
    echo 'ID: '.$user->id."\n";
} else {
    echo "No client users found.\n";
}
