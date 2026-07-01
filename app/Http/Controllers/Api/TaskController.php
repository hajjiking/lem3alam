<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\TaskApplication;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        $perPage = (int) $request->input('per_page', 15);

        $tasks = $this->taskService->search($filters, $perPage);

        return response()->json([
            'success' => true,
            'data' => $tasks,
        ]);
    }

    public function show(Task $task)
    {
        $task->load(['client', 'category', 'assignedTasker']);

        if (Auth::check() && $task->client_id === Auth::id()) {
            $task->load(['applications.tasker']);
        }

        return response()->json([
            'success' => true,
            'data' => $task,
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $images = $request->file('images');
        $count = is_array($images) ? count($images) : ($images ? 1 : 0);
        Log::info('API task create request received', [
            'user_id' => Auth::id(),
            'has_images' => $request->hasFile('images'),
            'images_count' => $count,
            'files_keys' => array_keys($request->allFiles()),
            'content_type' => $request->header('content-type'),
        ]);

        $task = $this->taskService->createTask(
            $request->validated(),
            $images
        );

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => $task,
        ], 201);
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        if ($task->client_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $images = $request->file('images');
        $count = is_array($images) ? count($images) : ($images ? 1 : 0);
        Log::info('API task update request received', [
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'has_images' => $request->hasFile('images'),
            'images_count' => $count,
            'files_keys' => array_keys($request->allFiles()),
            'content_type' => $request->header('content-type'),
        ]);

        $task = $this->taskService->updateTask(
            $task,
            $request->validated(),
            $images
        );

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $task,
        ]);
    }

    public function destroy(Task $task)
    {
        if ($task->client_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
        ]);
    }

    public function apply(ApplyTaskRequest $request, Task $task)
    {
        // Check if user already applied
        $existingApplication = TaskApplication::where('task_id', $task->id)
            ->where('tasker_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return response()->json([
                'success' => false,
                'message' => 'You have already applied to this task',
            ], 409);
        }

        // Check if task is still open
        if ($task->status !== 'open') {
            return response()->json([
                'success' => false,
                'message' => 'This task is no longer accepting applications',
            ], 409);
        }

        $application = $this->taskService->submitApplication($task, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully',
            'data' => $application,
        ], 201);
    }

    public function myTasks(Request $request)
    {
        $perPage = (int) $request->input('per_page', 15);

        $tasks = Task::where('client_id', Auth::id())
            ->with(['category', 'applications.tasker', 'assignedTasker'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $tasks,
        ]);
    }

    public function myApplications(Request $request)
    {
        $perPage = (int) $request->input('per_page', 15);

        $applications = TaskApplication::where('tasker_id', Auth::id())
            ->with(['task.client', 'task.category'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $applications,
        ]);
    }

    public function acceptApplication(TaskApplication $application)
    {
        $task = Task::findOrFail($application->task_id);

        if ($task->client_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        if ($task->status !== 'open') {
            return response()->json(['success' => false, 'message' => 'Task is not open'], 400);
        }

        $task->update(['status' => 'assigned', 'assigned_tasker_id' => $application->tasker_id]);
        $application->update(['status' => 'accepted']);

        // Reject other applications?
        // TaskApplication::where('task_id', $task->id)->where('id', '!=', $application->id)->update(['status' => 'rejected']);

        return response()->json(['success' => true, 'message' => 'Application accepted']);
    }

    public function rejectApplication(TaskApplication $application)
    {
        $task = Task::findOrFail($application->task_id);

        if ($task->client_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $application->update(['status' => 'rejected']);

        return response()->json(['success' => true, 'message' => 'Application rejected']);
    }
}
