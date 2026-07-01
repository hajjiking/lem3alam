@extends('admin.layouts.app')

@section('title', 'Dispute Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dispute Management</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.disputes.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create New Dispute
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>Complainant</th>
                                    <th>Respondent</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($disputes as $dispute)
                                    <tr>
                                        <td>{{ $dispute->id }}</td>
                                        <td>
                                            @if($dispute->task)
                                                <a href="{{ route('admin.tasks.show', $dispute->task) }}">
                                                    {{ $dispute->task->title }}
                                                </a>
                                            @else
                                                <span class="text-muted">No Task</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($dispute->complainant)
                                                <a href="{{ route('admin.users.show', $dispute->complainant) }}">
                                                    {{ $dispute->complainant->name }}
                                                </a>
                                            @else
                                                <span class="text-muted">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($dispute->respondent)
                                                <a href="{{ route('admin.users.show', $dispute->respondent) }}">
                                                    {{ $dispute->respondent->name }}
                                                </a>
                                            @else
                                                <span class="text-muted">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ ucfirst($dispute->type) }}</span>
                                        </td>
                                        <td>
                                            @if($dispute->status === 'open')
                                                <span class="badge badge-warning">Open</span>
                                            @elseif($dispute->status === 'in_progress')
                                                <span class="badge badge-info">In Progress</span>
                                            @elseif($dispute->status === 'resolved')
                                                <span class="badge badge-success">Resolved</span>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($dispute->status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $dispute->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.disputes.show', $dispute) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.disputes.edit', $dispute) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($dispute->status !== 'resolved')
                                                    <form action="{{ route('admin.disputes.resolve', $dispute) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to resolve this dispute?')">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.disputes.destroy', $dispute) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this dispute?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No disputes found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $disputes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection