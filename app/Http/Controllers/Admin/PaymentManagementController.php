<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $payments = Payment::with(['task', 'payer', 'payee'])->paginate(15);

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $tasks = Task::all();
        $users = User::all();

        return view('admin.payments.create', compact('tasks', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'payer_id' => 'required|exists:users,id',
            'payee_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'platform_fee' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'method' => 'required|string|max:255',
            'status' => 'required|in:pending,completed,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();

        // Calculate net amount if platform fee is provided
        if ($request->platform_fee) {
            $data['net_amount'] = $request->amount - $request->platform_fee;
        } else {
            $data['net_amount'] = $request->amount;
        }

        Payment::create($data);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment created successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['task', 'payer', 'payee']);

        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $tasks = Task::all();
        $users = User::all();

        return view('admin.payments.edit', compact('payment', 'tasks', 'users'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'payer_id' => 'required|exists:users,id',
            'payee_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'platform_fee' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'method' => 'required|string|max:255',
            'status' => 'required|in:pending,completed,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();

        // Calculate net amount if platform fee is provided
        if ($request->platform_fee) {
            $data['net_amount'] = $request->amount - $request->platform_fee;
        } else {
            $data['net_amount'] = $request->amount;
        }

        $payment->update($data);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
