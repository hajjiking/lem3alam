<?php

use App\Models\User;

$user = User::where('email', 'hajjizik@gmail.com')->first();

if (! $user) {
    echo "User not found\n";
    exit(1);
}

echo 'User: '.$user->email."\n";
echo 'Role: '.$user->role."\n";
echo 'ID: '.$user->id."\n";

if ($user->role !== 'client') {
    echo "Fixing role to client...\n";
    $user->role = 'client';
    $user->save();
    echo "Role updated to client\n";
} else {
    echo "Role is already client\n";
}
