@extends('admin.layouts.app')

@section('title', 'Task Details')
@section('page-title', 'Task Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Task Details</h2>
    <div>
        <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-primary">
            <i class="fas fa-edit fa-lg"></i> Edit Task
        </a>
        <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left fa-lg"></i> Back to Tasks
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Task Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>ID:</strong></div>
                    <div class="col-sm-9">{{ $task->id }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Title:</strong></div>
                    <div class="col-sm-9">{{ $task->title }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Description:</strong></div>
                    <div class="col-sm-9">{{ $task->description ?? 'No description provided' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Client:</strong></div>
                    <div class="col-sm-9">
                        @if($task->client)
                            <a href="{{ route('admin.users.show', $task->client) }}">{{ $task->client->name }}</a>
                        @else
                            N/A
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Assigned Tasker:</strong></div>
                    <div class="col-sm-9">
                        @if($task->assignedTasker)
                            <a href="{{ route('admin.users.show', $task->assignedTasker) }}">{{ $task->assignedTasker->name }}</a>
                        @else
                            Unassigned
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Category:</strong></div>
                    <div class="col-sm-9">{{ $task->category ? $task->category->name : 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Status:</strong></div>
                    <div class="col-sm-9">
                        <span class="badge bg-{{ $task->status == 'open' ? 'primary' : ($task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'warning' : 'secondary')) }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Budget:</strong></div>
                    <div class="col-sm-9">{{ number_format($task->budget, 2) }} MAD</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Location:</strong></div>
                    <div class="col-sm-9">{{ $task->location ?? 'Not specified' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Due Date:</strong></div>
                    <div class="col-sm-9">{{ $task->due_date ? $task->due_date->format('F d, Y') : 'Not specified' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Created:</strong></div>
                    <div class="col-sm-9">{{ $task->created_at->format('F d, Y \\a\\t g:i A') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Last Updated:</strong></div>
                    <div class="col-sm-9">{{ $task->updated_at->format('F d, Y \\a\\t g:i A') }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Task
                    </a>
                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        @if($task->taskApplications && $task->taskApplications->count() > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Applications ({{ $task->taskApplications->count() }})</h5>
            </div>
            <div class="card-body">
                @foreach($task->taskApplications as $application)
                    <div class="border-bottom pb-2 mb-2">
                        <strong>{{ $application->tasker->name }}</strong><br>
                        <small class="text-muted">Applied: {{ $application->created_at->format('M d, Y') }}</small>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection