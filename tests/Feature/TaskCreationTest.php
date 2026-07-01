<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_create_task_with_minimum_required_fields(): void
    {
        $client = User::factory()->client()->create();
        $category = Category::factory()->create();

        $payload = [
            'title' => 'Fix my website',
            'description' => 'Need to fix broken links and layout.',
            'category_id' => $category->id,
            'budget_min' => 250,
            'budget_type' => 'fixed',
            'payment_method' => 'cash',
            'is_remote' => true,
            'urgency' => 'medium',
            'location' => 'Remote',
        ];

        $response = $this->actingAs($client)
            ->post(localized_route('tasks.store'), $payload);

        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Fix my website',
            'client_id' => $client->id,
            'category_id' => $category->id,
            'status' => 'open',
            'budget_type' => 'fixed',
            'payment_method' => 'cash',
        ]);
    }
}
