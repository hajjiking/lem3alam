<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiTaskImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_create_task_and_photos_are_saved_to_task_images(): void
    {
        Storage::fake('public');

        $client = User::factory()->client()->create();
        $category = Category::factory()->create();

        Sanctum::actingAs($client);

        $tinyPng = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+X2b0AAAAASUVORK5CYII=');

        $payload = [
            'title' => 'Fix my sink',
            'description' => 'The sink is leaking water.',
            'category_id' => $category->id,
            'budget_min' => 100,
            'budget_max' => 150,
            'budget_type' => 'fixed',
            'payment_method' => 'cash',
            'urgency' => 'medium',
            'location' => 'Casablanca',
            'images' => [
                UploadedFile::fake()->createWithContent('a.png', $tinyPng),
                UploadedFile::fake()->createWithContent('b.png', $tinyPng),
            ],
        ];

        $response = $this->post('/api/v1/tasks', $payload, [
            'Accept' => 'application/json',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('success', true);

        $taskId = (int) $response->json('data.id');
        $paths = $response->json('data.images');

        $this->assertIsArray($paths);
        $this->assertCount(2, $paths);

        foreach ($paths as $path) {
            $this->assertIsString($path);
            $this->assertTrue(str_starts_with($path, 'task_images/'));
            $this->assertTrue(Storage::disk('public')->exists($path));
        }

        $task = Task::findOrFail($taskId);
        $this->assertEquals($paths, $task->images);
    }

    public function test_task_create_rejects_invalid_image_format(): void
    {
        Storage::fake('public');

        $client = User::factory()->client()->create();
        $category = Category::factory()->create();

        Sanctum::actingAs($client);

        $payload = [
            'title' => 'Task with invalid image',
            'description' => 'Should fail.',
            'category_id' => $category->id,
            'budget_min' => 10,
            'budget_max' => 20,
            'budget_type' => 'fixed',
            'urgency' => 'medium',
            'location' => 'Casablanca',
            'images' => [
                UploadedFile::fake()->create('not-an-image.pdf', 50, 'application/pdf'),
            ],
        ];

        $response = $this->post('/api/v1/tasks', $payload, [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['images.0']);
    }

    public function test_storage_route_serves_task_images_when_symlink_is_missing(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('task_images/test.png', 'abc');

        $response = $this->get('/storage/task_images/test.png');

        $response->assertOk();
        $response->assertHeader('cache-control');
    }
}
