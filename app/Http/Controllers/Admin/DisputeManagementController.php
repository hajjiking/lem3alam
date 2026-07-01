<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dispute;
use Illuminate\Http\Request;

class DisputeManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $disputes = Dispute::with(['task', 'client', 'tasker'])->paginate(15);

        return view('admin.disputes.index', compact('disputes'));
    }

    public function show(Dispute $dispute)
    {
        $dispute->load(['task', 'client', 'tasker']);

        return view('admin.disputes.show', compact('dispute'));
    }

    public function edit(Dispute $dispute)
    {
        return view('admin.disputes.edit', compact('dispute'));
    }

    public function update(Request $request, Dispute $dispute)
    {
        $request->validate([
            'status' => 'required|in:open,in_review,resolved,closed',
            'resolution' => 'nullable|string',
        ]);

        $dispute->update($request->only(['status', 'resolution']));

        return redirect()->route('admin.disputes.index')
            ->with('success', 'Dispute updated successfully.');
    }
}
