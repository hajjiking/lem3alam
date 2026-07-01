@extends('admin.layouts.app')

@section('title', 'Edit Dispute')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Dispute #{{ $dispute->id }}</h3>
                </div>
                <form action="{{ route('admin.disputes.update', $dispute) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="task_id">Task</label>
                                    <select class="form-control @error('task_id') is-invalid @enderror" id="task_id" name="task_id">
                                        <option value="">Select Task</option>
                                        @foreach($tasks as $task)
                                            <option value="{{ $task->id }}" {{ (old('task_id', $dispute->task_id) == $task->id) ? 'selected' : '' }}>
                                                {{ $task->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('task_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="complainant_id">Complainant *</label>
                                    <select class="form-control @error('complainant_id') is-invalid @enderror" id="complainant_id" name="complainant_id" required>
                                        <option value="">Select Complainant</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ (old('complainant_id', $dispute->complainant_id) == $user->id) ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('complainant_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="respondent_id">Respondent</label>
                                    <select class="form-control @error('respondent_id') is-invalid @enderror" id="respondent_id" name="respondent_id">
                                        <option value="">Select Respondent</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ (old('respondent_id', $dispute->respondent_id) == $user->id) ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('respondent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type *</label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="payment" {{ old('type', $dispute->type) === 'payment' ? 'selected' : '' }}>Payment</option>
                                        <option value="quality" {{ old('type', $dispute->type) === 'quality' ? 'selected' : '' }}>Quality</option>
                                        <option value="communication" {{ old('type', $dispute->type) === 'communication' ? 'selected' : '' }}>Communication</option>
                                        <option value="other" {{ old('type', $dispute->type) === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="status">Status *</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="open" {{ old('status', $dispute->status) === 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="in_progress" {{ old('status', $dispute->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ old('status', $dispute->status) === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description', $dispute->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="resolution">Resolution</label>
                            <textarea class="form-control @error('resolution') is-invalid @enderror" 
                                      id="resolution" name="resolution" rows="3">{{ old('resolution', $dispute->resolution) }}</textarea>
                            @error('resolution')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Dispute
                        </button>
                        <a href="{{ route('admin.disputes.show', $dispute) }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection