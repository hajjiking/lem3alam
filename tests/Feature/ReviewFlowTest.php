<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Review;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ReviewFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a category for tasks to link to
        if (Category::count() === 0) {
            Category::create([
                'name' => 'General',
                'name_translations' => ['en' => 'General', 'fr' => 'Général', 'ar' => 'عام'],
                'description' => 'General category',
                'description_translations' => ['en' => 'General', 'fr' => 'Général', 'ar' => 'عام'],
                'icon' => 'fa-home',
                'is_active' => true,
            ]);
        }
    }

    #[Test]
    public function authenticated_client_can_submit_review_for_tasker()
    {
        // 1. Setup
        /** @var \App\Models\User $client */
        $client = User::factory()->create(['role' => 'client']);
        /** @var \App\Models\User $tasker */
        $tasker = User::factory()->create(['role' => 'tasker']);

        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'client_id' => $client->id,
            'assigned_tasker_id' => $tasker->id,
            'status' => 'completed',
            'budget_min' => 100,
            'budget_max' => 200,
            'budget_type' => 'fixed',
            'category_id' => 1, // Assuming category 1 exists or validation doesn't check strict FK if not forced
            'location' => 'Test Location',
            'urgency' => 'medium',
        ]);

        $this->actingAs($client);

        // 2. Submit Review
        $response = $this->post(route('reviews.store', ['locale' => 'en', 'tasker' => $tasker->id]), [
            'task_id' => $task->id,
            'quality_rating' => 5,
            'communication_rating' => 4,
            'timeliness_rating' => 5,
            'professionalism_rating' => 5,
            'comment' => 'This is a test review with more than twenty characters.',
        ]);

        // 3. Assert Redirection
        $response->assertRedirect(route('tasker.profile.show', ['locale' => 'en', 'id' => $tasker->id]));
        $response->assertSessionHas('success');

        // 4. Assert Database Persistence
        $this->assertDatabaseHas('reviews', [
            'client_id' => $client->id,
            'tasker_id' => $tasker->id,
            'task_id' => $task->id,
            'status' => 'approved', // Must be immediately approved
            'rating' => 5, // (5+4+5+5)/4 = 4.75 -> round to 5
        ]);

        // 5. Assert Stats Update
        $tasker->refresh();
        $this->assertEquals(5, $tasker->rating);
        $this->assertEquals(1, $tasker->total_reviews);
    }

    #[Test]
    public function review_submission_fails_validation()
    {
        /** @var \App\Models\User $client */
        $client = User::factory()->create(['role' => 'client']);
        /** @var \App\Models\User $tasker */
        $tasker = User::factory()->create(['role' => 'tasker']);

        $this->actingAs($client);

        $response = $this->post(route('reviews.store', ['locale' => 'en', 'tasker' => $tasker->id]), [
            'quality_rating' => 6, // Invalid
            'comment' => 'Short', // Invalid
        ]);

        $response->assertSessionHasErrors(['quality_rating', 'comment']);
        $this->assertDatabaseCount('reviews', 0);
    }

    #[Test]
    public function cannot_submit_duplicate_review_for_same_task()
    {
        /** @var \App\Models\User $client */
        $client = User::factory()->create(['role' => 'client']);
        /** @var \App\Models\User $tasker */
        $tasker = User::factory()->create(['role' => 'tasker']);

        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'client_id' => $client->id,
            'assigned_tasker_id' => $tasker->id,
            'status' => 'completed',
            'budget_min' => 100,
            'budget_max' => 200,
            'budget_type' => 'fixed',
            'category_id' => 1,
            'location' => 'Test Location',
            'urgency' => 'medium',
        ]);

        $this->actingAs($client);

        // First submission
        $this->post(route('reviews.store', ['locale' => 'en', 'tasker' => $tasker->id]), [
            'task_id' => $task->id,
            'quality_rating' => 5,
            'communication_rating' => 5,
            'timeliness_rating' => 5,
            'professionalism_rating' => 5,
            'comment' => 'First review with enough characters.',
        ]);

        // Second submission
        $response = $this->post(route('reviews.store', ['locale' => 'en', 'tasker' => $tasker->id]), [
            'task_id' => $task->id,
            'quality_rating' => 4,
            'communication_rating' => 4,
            'timeliness_rating' => 4,
            'professionalism_rating' => 4,
            'comment' => 'Second review attempt.',
        ]);

        $response->assertSessionHas('error'); // Should flash error
        $this->assertDatabaseCount('reviews', 1); // Still only 1
    }

    #[Test]
    public function reviews_are_retrieved_correctly_for_profile()
    {
        /** @var \App\Models\User $tasker */
        $tasker = User::factory()->create(['role' => 'tasker']);
        /** @var \App\Models\User $client */
        $client = User::factory()->create(['role' => 'client']);

        // Create 3 reviews
        for ($i = 0; $i < 3; $i++) {
            $task = Task::create([
                'title' => "Review Task $i",
                'description' => 'Task for reviews',
                'client_id' => $client->id,
                'assigned_tasker_id' => $tasker->id,
                'status' => 'completed',
                'budget_min' => 100,
                'budget_max' => 200,
                'budget_type' => 'fixed',
                'category_id' => 1,
                'location' => 'Test Location',
                'urgency' => 'medium',
            ]);

            Review::create([
                'client_id' => $client->id,
                'tasker_id' => $tasker->id,
                'reviewee_id' => $tasker->id,
                'reviewer_id' => $client->id,
                'task_id' => $task->id,
                'rating' => 4,
                'comment' => "Review number $i",
                'status' => 'approved',
                'type' => 'task',
            ]);
        }

        $tasker->updateRatingStats();

        // Access profile page
        $response = $this->get(route('tasker.profile.show', ['locale' => 'en', 'id' => $tasker->id]));

        $response->assertStatus(200);
        $response->assertSee('Review number 0');
        $response->assertSee('Review number 1');
        $response->assertSee('Review number 2');
    }
}
