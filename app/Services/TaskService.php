<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Task;
use App\Models\TaskApplication;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TaskService
{
    private const TASK_IMAGE_DIR = 'task_images';

    /**
     * Search for tasks with advanced filters.
     */
    public function search(array $filters, int $perPage = 15)
    {
        $query = Task::with(['client', 'category'])
            ->where('status', 'open');

        // Text search
        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if (! empty($filters['category_id'])) {
            $selected = Category::query()->active()->with('children')->find($filters['category_id']);
            if ($selected) {
                $categoryIds = [$selected->id];
                if ($selected->children->isNotEmpty()) {
                    $categoryIds = array_merge($categoryIds, $selected->children->pluck('id')->all());
                }
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // City filter
        if (! empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        // Budget filters
        if (! empty($filters['budget_min'])) {
            $query->where('budget_max', '>=', $filters['budget_min']);
        }

        if (! empty($filters['budget_max'])) {
            $query->where('budget_min', '<=', $filters['budget_max']);
        }

        // Urgency filter
        if (! empty($filters['urgency'])) {
            $query->where('urgency', $filters['urgency']);
        }

        // Remote filter
        if (isset($filters['is_remote'])) {
            $query->where('is_remote', filter_var($filters['is_remote'], FILTER_VALIDATE_BOOLEAN));
        }

        // Location-based search (Geospatial)
        if (! empty($filters['latitude']) && ! empty($filters['longitude']) && ! empty($filters['radius'])) {
            $lat = $filters['latitude'];
            $lng = $filters['longitude'];
            $radius = $filters['radius']; // in kilometers

            $query->whereRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) <= ?',
                [$lat, $lng, $lat, $radius]
            );
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Create a new task with optional image uploads.
     */
    public function createTask(array $data, array|UploadedFile|null $images = null): Task
    {
        $imagePaths = $this->storeTaskImages($images, [
            'operation' => 'createTask',
            'client_id' => Auth::id(),
        ]);

        $location = $data['location'] ?? null;
        if (! $location) {
            $location = $data['address'] ?? null;
        }
        if (! $location) {
            $location = $data['city'] ?? null;
        }

        $budgetType = $data['budget_type'];
        if ($budgetType === 'negotiable') {
            $budgetType = 'project';
        }

        // Prepare task data
        $taskData = [
            'client_id' => Auth::id(),
            'title' => $data['title'],
            'title_translations' => $data['title_translations'] ?? null,
            'description' => $data['description'],
            'description_translations' => $data['description_translations'] ?? null,
            'category_id' => $data['category_id'],
            'budget_min' => $data['budget_min'],
            'budget_max' => $data['budget_max'],
            'budget_type' => $budgetType,
            'payment_method' => $data['payment_method'] ?? 'cash',
            'location' => $location,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'urgency' => $data['urgency'],
            'deadline' => $data['deadline'] ?? null,
            'required_skills' => $data['required_skills'] ?? null,
            'images' => $imagePaths,
            'is_remote' => isset($data['is_remote']) ? (bool) $data['is_remote'] : false,
            'status' => 'open',
        ];

        // Create the task
        $task = Task::create($taskData);

        Log::info('Task created', [
            'task_id' => $task->id,
            'client_id' => $task->client_id,
            'images_count' => count($imagePaths),
            'images_dir' => self::TASK_IMAGE_DIR,
        ]);

        // Eager load relationships for the response
        $task->load(['client', 'category']);

        return $task;
    }

    /**
     * Update a task with optional image uploads.
     */
    public function updateTask(Task $task, array $data, array|UploadedFile|null $images = null): Task
    {
        if (array_key_exists('budget_type', $data) && $data['budget_type'] === 'negotiable') {
            $data['budget_type'] = 'project';
        }

        $location = $data['location'] ?? null;
        if (! $location) {
            $location = $data['address'] ?? null;
        }
        if (! $location) {
            $location = $data['city'] ?? null;
        }
        if ($location !== null) {
            $data['location'] = $location;
        }
        unset($data['city'], $data['address']);

        if ($images) {
            $oldImages = (array) ($task->images ?? []);
            foreach ($oldImages as $old) {
                $oldPath = (string) $old;
                if ($oldPath !== '') {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $imagePaths = $this->storeTaskImages($images, [
                'operation' => 'updateTask',
                'task_id' => $task->id,
                'client_id' => Auth::id(),
            ]);
            $data['images'] = $imagePaths;
        }

        $task->update($data);
        $task->load(['client', 'category']);

        return $task;
    }

    private function storeTaskImages(array|UploadedFile|null $images, array $context): array
    {
        if ($images === null) {
            return [];
        }

        $files = [];
        if ($images instanceof UploadedFile) {
            $files = [$images];
        } elseif (is_array($images)) {
            $files = array_values(array_filter($images));
        }

        if (empty($files)) {
            return [];
        }

        $paths = [];
        try {
            Storage::disk('public')->makeDirectory(self::TASK_IMAGE_DIR);

            Log::info('Task images upload started', [
                ...$context,
                'files_count' => count($files),
                'disk' => 'public',
                'dir' => self::TASK_IMAGE_DIR,
                'sizes' => array_map(fn (UploadedFile $f) => $f->getSize(), $files),
                'mimes' => array_map(fn (UploadedFile $f) => $f->getMimeType(), $files),
                'original_names' => array_map(fn (UploadedFile $f) => $f->getClientOriginalName(), $files),
            ]);

            foreach ($files as $file) {
                $paths[] = $file->store(self::TASK_IMAGE_DIR, 'public');
            }

            Log::info('Task images upload stored', [
                ...$context,
                'stored_count' => count($paths),
                'paths' => $paths,
            ]);

            return $paths;
        } catch (\Throwable $e) {
            Log::error('Task images upload failed', [
                ...$context,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
            ]);

            throw ValidationException::withMessages([
                'images' => ['Failed to store uploaded images.'],
            ]);
        }
    }

    /**
     * Submit an application for a task.
     */
    public function submitApplication(Task $task, array $data): TaskApplication
    {
        $application = TaskApplication::create([
            'task_id' => $task->id,
            'tasker_id' => Auth::id(),
            'proposal' => $data['proposal'],
            'proposal_translations' => $data['proposal_translations'] ?? null,
            'proposed_budget' => $data['proposed_budget'],
            'estimated_duration' => $data['estimated_duration'],
            'experience_description' => $data['experience_description'] ?? null,
            'portfolio_items' => $data['portfolio_items'] ?? null,
            'status' => 'pending',
        ]);

        // Increment application count
        $task->increment('applications_count');

        // Load relationships
        $application->load('tasker');

        return $application;
    }
}
