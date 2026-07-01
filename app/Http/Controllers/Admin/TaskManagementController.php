<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $tasks = Task::with(['client', 'assignedTasker', 'category'])->paginate(15);

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $clients = User::where('role', 'client')->get();
        $taskers = User::where('role', 'tasker')->get();
        $categories = Category::all();

        return view('admin.tasks.create', compact('clients', 'taskers', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'budget_type' => 'required|in:fixed,hourly,project',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
            'location' => 'nullable|string|max:255',
            'due_date' => 'nullable|date|after:today',
            'status' => 'required|in:open,in_progress,completed,cancelled',
        ]);

        Task::create($request->all());

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $task->load(['client', 'assignedTasker', 'category', 'taskApplications.tasker']);

        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $clients = User::where('role', 'client')->get();
        $taskers = User::where('role', 'tasker')->get();
        $categories = Category::all();

        return view('admin.tasks.edit', compact('task', 'clients', 'taskers', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'budget_type' => 'required|in:fixed,hourly,project',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
            'location' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'status' => 'required|in:open,in_progress,completed,cancelled',
        ]);

        $task->update($request->all());

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
