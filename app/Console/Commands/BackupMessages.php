<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;

class BackupMessages extends Command
{
    protected $signature = 'messages:backup';

    protected $description = 'Archive messages older than 90 days to storage';

    public function handle(): int
    {
        $cut = now()->subDays(90);
        $data = Message::where('created_at', '<', $cut)->orderBy('created_at')->get()->toArray();
        $dir = storage_path('app/backups');
        if (! is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }
        $file = $dir.'/messages-'.now()->format('Y-m-d').'.json';
        file_put_contents($file, json_encode($data));

        return 0;
    }
}
