@extends('admin.layouts.app')

@section('title', 'Edit Payment')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Payment</h3>
                </div>
                <form action="{{ route('admin.payments.update', $payment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="task_id">Task *</label>
                                    <select class="form-control @error('task_id') is-invalid @enderror" id="task_id" name="task_id" required>
                                        <option value="">Select Task</option>
                                        @foreach($tasks as $task)
                                            <option value="{{ $task->id }}" {{ old('task_id', $payment->task_id) == $task->id ? 'selected' : '' }}>
                                                {{ $task->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('task_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="client_id">Client *</label>
                                    <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ old('client_id', $payment->client_id) == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="tasker_id">Tasker *</label>
                                    <select class="form-control @error('tasker_id') is-invalid @enderror" id="tasker_id" name="tasker_id" required>
                                        <option value="">Select Tasker</option>
                                        @foreach($taskers as $tasker)
                                            <option value="{{ $tasker->id }}" {{ old('tasker_id', $payment->tasker_id) == $tasker->id ? 'selected' : '' }}>
                                                {{ $tasker->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tasker_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount *</label>
                                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" name="amount" value="{{ old('amount', $payment->amount) }}" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="status">Status *</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="pending" {{ old('status', $payment->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ old('status', $payment->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="failed" {{ old('status', $payment->status) === 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="refunded" {{ old('status', $payment->status) === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="payment_method">Payment Method *</label>
                                    <select class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                        <option value="credit_card" {{ old('payment_method', $payment->payment_method) === 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="paypal" {{ old('payment_method', $payment->payment_method) === 'paypal' ? 'selected' : '' }}>PayPal</option>
                                        <option value="bank_transfer" {{ old('payment_method', $payment->payment_method) === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="cash" {{ old('payment_method', $payment->payment_method) === 'cash' ? 'selected' : '' }}>Cash</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="transaction_id">Transaction ID</label>
                                    <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" 
                                           id="transaction_id" name="transaction_id" value="{{ old('transaction_id', $payment->transaction_id) }}">
                                    @error('transaction_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Payment
                        </button>
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection