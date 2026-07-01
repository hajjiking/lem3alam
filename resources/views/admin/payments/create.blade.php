@extends('admin.layouts.app')

@section('title', 'Create Payment')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New Payment</h3>
                </div>
                <form action="{{ route('admin.payments.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="task_id">Task *</label>
                                    <select class="form-control @error('task_id') is-invalid @enderror" id="task_id" name="task_id" required>
                                        <option value="">Select Task</option>
                                        @foreach($tasks as $task)
                                            <option value="{{ $task->id }}" {{ old('task_id') == $task->id ? 'selected' : '' }}>
                                                {{ $task->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('task_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="payer_id">Payer *</label>
                                    <select class="form-control @error('payer_id') is-invalid @enderror" id="payer_id" name="payer_id" required>
                                        <option value="">Select Payer</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('payer_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('payer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="payee_id">Payee *</label>
                                    <select class="form-control @error('payee_id') is-invalid @enderror" id="payee_id" name="payee_id" required>
                                        <option value="">Select Payee</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('payee_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('payee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount *</label>
                                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" name="amount" value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="platform_fee">Platform Fee</label>
                                    <input type="number" step="0.01" class="form-control @error('platform_fee') is-invalid @enderror" 
                                           id="platform_fee" name="platform_fee" value="{{ old('platform_fee') }}">
                                    @error('platform_fee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="currency">Currency *</label>
                                    <select class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency" required>
                                        <option value="MAD" {{ old('currency') === 'MAD' ? 'selected' : '' }}>MAD</option>
                                        <option value="USD" {{ old('currency') === 'USD' ? 'selected' : '' }}>USD</option>
                                        <option value="EUR" {{ old('currency') === 'EUR' ? 'selected' : '' }}>EUR</option>
                                        <option value="GBP" {{ old('currency') === 'GBP' ? 'selected' : '' }}>GBP</option>
                                    </select>
                                    @error('currency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="status">Status *</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="failed" {{ old('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="refunded" {{ old('status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="method">Payment Method *</label>
                                    <select class="form-control @error('method') is-invalid @enderror" id="method" name="method" required>
                                        <option value="credit_card" {{ old('method') === 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="paypal" {{ old('method') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                                        <option value="bank_transfer" {{ old('method') === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="cash" {{ old('method') === 'cash' ? 'selected' : '' }}>Cash</option>
                                    </select>
                                    @error('method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="transaction_id">Transaction ID</label>
                                    <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" 
                                           id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}">
                                    @error('transaction_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Payment
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