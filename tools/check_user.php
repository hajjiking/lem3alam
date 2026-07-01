<?php

require_once __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$id = isset($argv[1]) ? (int) $argv[1] : null;
if (! $id) {
    fwrite(STDERR, "Usage: php tools/check_user.php <user_id>\n");
    exit(1);
}

$u = User::find($id);
if ($u) {
    echo "FOUND id={$u->id} role={$u->role} name={$u->name}\n";
    echo 'status='.($u->status ?? 'unknown').' is_verified='.(($u->is_verified ?? false) ? 'true' : 'false')."\n";
} else {
    echo "NOT_FOUND id={$id}\n";
}
