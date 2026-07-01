<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Task;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Get payments for authenticated user
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Payment::where('payee_id', $user->id)
            ->with(['task', 'user']);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method')) {
            $query->where('method', $request->payment_method);
        }

        $payments = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $payments,
            'message' => 'Payments retrieved successfully',
        ]);
    }

    /**
     * Get payment details
     */
    public function show(Request $request, $paymentId)
    {
        $payment = Payment::with(['task', 'user', 'commission'])->find($paymentId);

        if (! $payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found',
            ], 404);
        }

        $user = $request->user();

        // Check if user is authorized to view this payment
        if ($payment->payee_id !== $user->id && ($payment->task?->getAttribute('client_id')) !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to view this payment',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $payment,
            'message' => 'Payment details retrieved successfully',
        ]);
    }

    /**
     * Create payment for a task
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'payment_method' => 'required|in:cash,bank_transfer,mobile_money',
            'amount' => 'required|numeric|min:0',
        ]);

        $task = Task::find($request->task_id);

        $user = $request->user();

        // Only task owner can create payment
        if ($task->client_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Only task owner can create payment',
            ], 403);
        }

        $payment = Payment::create([
            'task_id' => $task->id,
            'payer_id' => $user->id,
            'payee_id' => $task->assigned_tasker_id,
            'amount' => $request->amount,
            'platform_fee' => 0,
            'net_amount' => $request->amount,
            'currency' => 'MAD',
            'method' => $request->payment_method,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'data' => $payment]);
    }

    public function release(Request $request, Payment $payment)
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        if ($payment->payer_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        if ($payment->status !== 'completed') {
            return response()->json(['success' => false, 'message' => 'Payment is not completed'], 400);
        }

        if ($payment->released_at !== null) {
            return response()->json(['success' => false, 'message' => 'Payment already released'], 409);
        }

        $payment->update(['released_at' => now()]);

        return response()->json(['success' => true, 'message' => 'Payment released']);
    }
}
