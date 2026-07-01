@extends('admin.layouts.app')

@section('title', 'Dispute Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dispute #{{ $dispute->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.disputes.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left fa-lg"></i> Back to Disputes
                        </a>
                        <a href="{{ route('admin.disputes.edit', $dispute) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Dispute Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">ID:</th>
                                    <td>{{ $dispute->id }}</td>
                                </tr>
                                <tr>
                                    <th>Type:</th>
                                    <td><span class="badge badge-info">{{ ucfirst($dispute->type) }}</span></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
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
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $dispute->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @if($dispute->resolved_at)
                                <tr>
                                    <th>Resolved:</th>
                                    <td>{{ $dispute->resolved_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Related Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Task:</th>
                                    <td>
                                        @if($dispute->task)
                                            <a href="{{ route('admin.tasks.show', $dispute->task) }}">
                                                {{ $dispute->task->title }}
                                            </a>
                                        @else
                                            <span class="text-muted">No Task</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Complainant:</th>
                                    <td>
                                        @if($dispute->complainant)
                                            <a href="{{ route('admin.users.show', $dispute->complainant) }}">
                                                {{ $dispute->complainant->name }}
                                            </a>
                                        @else
                                            <span class="text-muted">Unknown</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Respondent:</th>
                                    <td>
                                        @if($dispute->respondent)
                                            <a href="{{ route('admin.users.show', $dispute->respondent) }}">
                                                {{ $dispute->respondent->name }}
                                            </a>
                                        @else
                                            <span class="text-muted">Unknown</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($dispute->description)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Description</h5>
                            <div class="card">
                                <div class="card-body">
                                    {{ $dispute->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($dispute->resolution)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Resolution</h5>
                            <div class="card">
                                <div class="card-body">
                                    {{ $dispute->resolution }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    @if($dispute->status !== 'resolved')
                        <form action="{{ route('admin.disputes.resolve', $dispute) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to resolve this dispute?')">
                                <i class="fas fa-check"></i> Mark as Resolved
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('admin.disputes.destroy', $dispute) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this dispute?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection