@extends('admin.layouts.app')

@section('title', 'Payment Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Payment Details</h3>
                    <div>
                        <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">ID:</th>
                                    <td>{{ $payment->id }}</td>
                                </tr>
                                <tr>
                                    <th>Task:</th>
                                    <td>{{ $payment->task ? $payment->task->title : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Client:</th>
                                    <td>{{ $payment->client ? $payment->client->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Tasker:</th>
                                    <td>{{ $payment->tasker ? $payment->tasker->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Amount:</th>
                                    <td>{{ number_format($payment->amount, 2) }} MAD</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge badge-{{ $payment->status === 'completed' ? 'success' : ($payment->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                </tr>
                                <tr>
                                    <th>Transaction ID:</th>
                                    <td>{{ $payment->transaction_id ?: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $payment->created_at->format('F d, Y \\a\\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $payment->updated_at->format('F d, Y \\a\\t g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            @if($payment->notes)
                                <h5>Notes</h5>
                                <p class="border p-3 bg-light">{{ $payment->notes }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection