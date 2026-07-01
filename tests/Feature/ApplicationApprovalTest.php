<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationApprovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_accept_an_application_and_reject_others(): void
    {
        $client = User::factory()->client()->create();
        $tasker1 = User::factory()->tasker()->create();
        $tasker2 = User::factory()->tasker()->create();
        $task = Task::factory()->for($client, 'client')->create(['status' => 'open']);

        $application1 = TaskApplication::factory()->for($task, 'task')->for($tasker1, 'tasker')->create();
        $application2 = TaskApplication::factory()->for($task, 'task')->for($tasker2, 'tasker')->create();

        $response = $this->actingAs($client)
            ->post(localized_route('applications.accept', ['application' => $application1->id]));

        $response->assertRedirect();

        $this->assertDatabaseHas('task_applications', [
            'id' => $application1->id,
            'status' => 'accepted',
        ]);

        $this->assertDatabaseHas('task_applications', [
            'id' => $application2->id,
            'status' => 'rejected',
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'assigned',
            'assigned_tasker_id' => $tasker1->id,
        ]);
    }
}
