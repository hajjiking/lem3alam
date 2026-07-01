@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Category Details</h3>
                    <div>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left fa-lg"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Merge duplicate</strong>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.categories.merge', $category) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="target_id">Merge this category into:</label>
                                            <select id="target_id" name="target_id" class="form-control" required>
                                                <option value="" selected disabled>Select target category</option>
                                                @foreach(($mergeTargets ?? collect())->where('parent_id', $category->parent_id) as $t)
                                                    <option value="{{ $t->id }}">#{{ $t->id }} — {{ $t->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Only categories with the same parent are shown.</small>
                                        </div>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Merge and delete this category? Tasks/skills/portfolio will be moved to the target.')">
                                            Merge & Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">ID:</th>
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $category->description ?: 'No description provided' }}</td>
                                </tr>
                                <tr>
                                    <th>Tasks Count:</th>
                                    <td>{{ $category->tasks->count() }}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $category->created_at->format('F d, Y \\a\\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $category->updated_at->format('F d, Y \\a\\t g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($category->tasks->count() > 0)
                        <hr>
                        <h5>Recent Tasks in this Category</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Client</th>
                                        <th>Status</th>
                                        <th>Budget</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->tasks->take(10) as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->client ? $task->client->name : 'N/A' }}</td>
                                            <td>
                                                <span class="badge badge-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($task->budget, 2) }} MAD</td>
                                            <td>{{ $task->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
