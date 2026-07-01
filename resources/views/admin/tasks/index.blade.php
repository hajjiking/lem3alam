@extends('admin.layouts.app')

@section('title', 'Task Management')
@section('page-title', 'Task Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tasks</h2>
    <div>
        <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Task
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Client</th>
                        <th>Assigned Tasker</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Budget</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ Str::limit($task->title, 30) }}</td>
                            <td>{{ $task->client ? $task->client->name : 'N/A' }}</td>
                            <td>{{ $task->assignedTasker ? $task->assignedTasker->name : 'Unassigned' }}</td>
                            <td>{{ $task->category ? $task->category->name : 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $task->status == 'open' ? 'primary' : ($task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'warning' : 'secondary')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>
                            <td>{{ number_format($task->budget, 2) }} MAD</td>
                            <td>{{ $task->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.tasks.show', $task) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No tasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection