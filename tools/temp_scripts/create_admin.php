<?php

require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "Creating admin user...\n";

try {
    // Check if admin user already exists
    $existingAdmin = User::where('email', 'admin@m3alam.com')->first();

    if ($existingAdmin) {
        echo "Admin user already exists: {$existingAdmin->email}\n";
        echo "Updating to ensure admin role...\n";
        $existingAdmin->update([
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
        echo "Admin user updated successfully!\n";
    } else {
        // Create new admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@m3alam.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'status' => 'active',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        echo "Admin user created successfully!\n";
        echo "Email: admin@m3alam.com\n";
        echo "Password: admin123\n";
    }

    echo "\nYou can now login to the admin panel at: http://127.0.0.1:8000/admin/login\n";

} catch (Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
    echo "Make sure your database is running and configured properly.\n";
}
