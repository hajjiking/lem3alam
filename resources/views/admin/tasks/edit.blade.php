@extends('admin.layouts.app')

@section('title', 'Edit Task')
@section('page-title', 'Edit Task')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Task</h2>
    <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left fa-lg"></i> Back to Tasks
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $task->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="open" {{ old('status', $task->status) == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $task->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="budget_type" class="form-label">Budget Type</label>
                        <select class="form-select @error('budget_type') is-invalid @enderror" id="budget_type" name="budget_type" required>
                            <option value="">Select budget type</option>
                            <option value="fixed" {{ old('budget_type', $task->budget_type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="hourly" {{ old('budget_type', $task->budget_type) == 'hourly' ? 'selected' : '' }}>Hourly</option>
                            <option value="project" {{ old('budget_type', $task->budget_type) == 'project' ? 'selected' : '' }}>Project</option>
                        </select>
                        @error('budget_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="budget_min" class="form-label">Min Budget</label>
                        <input type="number" step="0.01" class="form-control @error('budget_min') is-invalid @enderror" 
                               id="budget_min" name="budget_min" value="{{ old('budget_min', $task->budget_min) }}" required>
                        @error('budget_min')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="budget_max" class="form-label">Max Budget</label>
                        <input type="number" step="0.01" class="form-control @error('budget_max') is-invalid @enderror" 
                               id="budget_max" name="budget_max" value="{{ old('budget_max', $task->budget_max) }}">
                        @error('budget_max')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                               id="location" name="location" value="{{ old('location', $task->location) }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                               id="due_date" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Task</button>
            </div>
        </form>
    </div>
</div>
@endsection