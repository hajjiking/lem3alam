@extends('admin.layouts.app')

@section('title', 'Payment Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Payments</h3>
                    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Payment
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>Client</th>
                                    <th>Tasker</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->task ? $payment->task->title : 'N/A' }}</td>
                                        <td>{{ $payment->client ? $payment->client->name : 'N/A' }}</td>
                                        <td>{{ $payment->tasker ? $payment->tasker->name : 'N/A' }}</td>
                                        <td>{{ number_format($payment->amount, 2) }} MAD</td>
                                        <td>
                                            <span class="badge badge-{{ $payment->status === 'completed' ? 'success' : ($payment->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                        <td>{{ ucfirst($payment->payment_method) }}</td>
                                        <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this payment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No payments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($payments->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $payments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection