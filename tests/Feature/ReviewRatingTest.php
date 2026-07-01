<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewRatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_review_submission_saves_criteria_and_overall_rating()
    {
        $client = User::factory()->create(['role' => 'client']);
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
            'budget_max' => 100,
            'budget_type' => 'fixed',
            'location' => 'Remote',
            'status' => 'completed',
            'applications_count' => 0,
        ]);

        $this->actingAs($client);

        $payload = [
            'task_id' => $task->id,
            'quality_rating' => 5,
            'communication_rating' => 4,
            'timeliness_rating' => 3,
            'professionalism_rating' => 4,
            'comment' => 'Excellent work overall with great communication.',
        ];

        $response = $this->post(localized_route('reviews.store', $tasker->id), $payload);
        $response->assertRedirect(route('tasker.profile.show', $tasker));

        $this->assertDatabaseHas('reviews', [
            'client_id' => $client->id,
            'tasker_id' => $tasker->id,
            'task_id' => $task->id,
            'rating' => 4, // average(5,4,3,4)=4
            'status' => 'approved',
        ]);
    }
}
