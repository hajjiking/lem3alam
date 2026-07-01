<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasker_can_apply_to_open_task(): void
    {
        /** @var \App\Models\Task $task */
        $task = Task::factory()->create([
            'status' => 'open',
            'is_remote' => true,
        ]);
        /** @var \App\Models\User $tasker */
        $tasker = User::factory()->tasker()->create();

        $payload = [
            'proposal' => 'I can complete this quickly with quality.',
            'proposed_budget' => 300,
            'estimated_duration' => 5,
        ];

        $response = $this->actingAs($tasker)
            ->post(localized_route('tasks.apply', ['id' => $task->id]), $payload);

        $response->assertRedirect();

        $this->assertDatabaseHas('task_applications', [
            'task_id' => $task->id,
            'tasker_id' => $tasker->id,
            'status' => 'pending',
        ]);

        $task->refresh();
        $this->assertEquals(1, $task->applications_count);
    }
}
