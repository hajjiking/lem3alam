<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_open_review_create_for_completed_task()
    {
        /** @var \App\Models\User $client */
        $client = User::factory()->create(['role' => 'client']);
        /** @var \App\Models\User $tasker */
        $tasker = User::factory()->create(['role' => 'tasker']);
        $category = Category::create([
            'name' => 'General',
            'name_translations' => ['fr' => 'Général', 'ar' => 'عام', 'en' => 'General'],
            'description' => 'General category',
            'description_translations' => ['fr' => 'Catégorie générale', 'ar' => 'فئة عامة', 'en' => 'General category'],
            'is_active' => true,
        ]);

        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Task description',
            'client_id' => $client->id,
            'category_id' => $category->id,
            'assigned_tasker_id' => $tasker->id,
            'budget_min' => 100,
            'budget_max' => 150,
            'budget_type' => 'fixed',
            'location' => 'Remote',
            'status' => 'completed',
            'applications_count' => 0,
        ]);

        $this->actingAs($client);

        $response = $this->get("/en/taskers/{$tasker->id}/reviews/create/{$task->id}");
        $response->assertStatus(200);
        $response->assertSee('Rate Your Experience');
        $response->assertSee($tasker->name);
    }
}
