<?php

namespace Tests\Feature;

use App\Models\PortfolioItem;
use App\Models\Review;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTaskerProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasker_profile_returns_profile_skills_and_portfolio(): void
    {
        $tasker = User::factory()->tasker()->create([
            'hourly_rate' => 120,
            'available' => true,
            'city' => 'Casablanca',
        ]);

        PortfolioItem::create([
            'user_id' => $tasker->id,
            'title' => 'Portfolio Item',
            'description' => 'Work sample',
            'description_translations' => ['en' => 'Work sample'],
            'image_path' => 'portfolio/test.png',
            'image_alt' => 'Test',
            'category_id' => null,
            'task_id' => null,
            'tags' => ['a', 'b'],
            'is_featured' => false,
            'display_order' => 0,
            'status' => 'active',
        ]);

        $response = $this->getJson("/api/v1/taskers/{$tasker->id}");

        $response->assertOk();
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('data.id', $tasker->id);
        $response->assertJsonPath('data.hourly_rate', '120.00');
        $response->assertJsonPath('data.available', true);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'name',
                'city',
                'address',
                'bio',
                'phone',
                'profile_image',
                'hourly_rate',
                'available',
                'is_verified',
                'average_rating',
                'total_reviews',
                'skills',
                'portfolio',
                'social_accounts',
            ],
        ]);
    }

    public function test_tasker_reviews_support_rating_filter_and_sort(): void
    {
        $client = User::factory()->client()->create();
        $client2 = User::factory()->client()->create();
        $tasker = User::factory()->tasker()->create();
        $task = Task::factory()->create(['client_id' => $client->id, 'assigned_tasker_id' => $tasker->id]);

        Review::create([
            'task_id' => $task->id,
            'reviewer_id' => $client->id,
            'reviewee_id' => $tasker->id,
            'client_id' => $client->id,
            'tasker_id' => $tasker->id,
            'rating' => 5,
            'comment' => 'Great',
            'comment_translations' => ['en' => 'Great'],
            'type' => 'client_to_tasker',
            'is_public' => true,
            'status' => 'approved',
        ]);

        Review::create([
            'task_id' => $task->id,
            'reviewer_id' => $client2->id,
            'reviewee_id' => $tasker->id,
            'client_id' => $client2->id,
            'tasker_id' => $tasker->id,
            'rating' => 3,
            'comment' => 'Ok',
            'comment_translations' => ['en' => 'Ok'],
            'type' => 'client_to_tasker',
            'is_public' => true,
            'status' => 'approved',
        ]);

        $response = $this->getJson("/api/v1/taskers/{$tasker->id}/reviews?rating=5&sort=newest&per_page=10");

        $response->assertOk();
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('data.total_reviews', 2);
        $response->assertJsonPath('data.reviews.total', 1);
        $response->assertJsonPath('data.reviews.data.0.rating', 5);
    }
}
