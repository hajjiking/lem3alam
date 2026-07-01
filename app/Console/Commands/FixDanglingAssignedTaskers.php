<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;

class FixDanglingAssignedTaskers extends Command
{
    protected $signature = 'tasks:fix-assignees {--open-missing : Reopen tasks with missing assignees if not completed}';

    protected $description = 'Clear assigned_tasker_id for tasks pointing to non-existent users';

    public function handle()
    {
        $ids = Task::whereNotNull('assigned_tasker_id')->pluck('assigned_tasker_id')->unique()->values();
        $existing = User::whereIn('id', $ids)->pluck('id')->all();
        $dangling = Task::whereNotNull('assigned_tasker_id')
            ->whereNotIn('assigned_tasker_id', $existing)
            ->get();

        if ($dangling->isEmpty()) {
            $this->info('No tasks with dangling assigned_tasker_id found.');

            return Command::SUCCESS;
        }

        $reopened = 0;
        foreach ($dangling as $task) {
            $task->assigned_tasker_id = null;
            if ($this->option('open-missing') && in_array($task->status, ['assigned', 'in_progress'])) {
                $task->status = 'open';
                $task->assigned_at = null;
                $task->started_at = null;
                $task->completion_requested_at = null;
                $reopened++;
            }
            $task->save();
            $this->line("Fixed task #{$task->id}");
        }

        $this->info("Fixed {$dangling->count()} tasks. Reopened: {$reopened}");

        return Command::SUCCESS;
    }
}
