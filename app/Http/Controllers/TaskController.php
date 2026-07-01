<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // ✅ أضفنا Auth facade
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with(['client', 'category'])
            ->where('status', 'open')
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }

        if ($request->filled('budget_min') && $request->filled('budget_max')) {
            $query->byBudget($request->budget_min, $request->budget_max);
        }

        if ($request->filled('urgency')) {
            $query->where('urgency', $request->urgency);
        }

        if ($request->filled('is_remote')) {
            $query->where('is_remote', $request->is_remote);
        }

        $tasks = $query->paginate(12);
        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function show($locale, $id)
    {
        $task = Task::with(['client', 'category', 'applications.user'])
            ->findOrFail($id);

        $canApply = Auth::check() &&
                   Auth::user()->role === 'tasker' &&
                   $task->status === 'open' &&
                   ! $task->applications()->where('tasker_id', Auth::id())->exists();

        return view('tasks.show', compact('task', 'canApply'));
    }

    public function apply(Request $request, $locale, $id)
    {
        $request->validate([
            'proposal' => 'required|string|max:1000',
            'proposed_budget' => 'required|numeric|min:0',
            'estimated_duration' => 'required|integer|min:1',
        ]);

        $task = Task::findOrFail($id);

        if (! Auth::check() || Auth::user()->role !== 'tasker') {
            return redirect(localized_route('login'))->with('error', 'يجب تسجيل الدخول كمنفذ مهام للتقديم');
        }

        if ($task->status !== 'open') {
            return back()->with('error', 'هذه المهمة غير متاحة للتقديم');
        }

        if ($task->applications()->where('tasker_id', Auth::id())->exists()) {
            return back()->with('error', 'لقد قدمت بالفعل على هذه المهمة');
        }

        $task->applications()->create([
            'tasker_id' => Auth::id(),
            'proposal' => $request->proposal,
            'proposed_budget' => $request->proposed_budget,
            'estimated_duration' => $request->estimated_duration,
            'status' => 'pending',
        ]);

        $task->increment('applications_count');

        return back()->with('success', 'تم تقديم طلبك بنجاح!');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect(localized_route('tasks.index'));
        }

        $tasks = Task::with(['client', 'category'])
            ->where('status', 'open')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%'.$query.'%')
                    ->orWhere('description', 'like', '%'.$query.'%')
                    ->orWhereHas('category', function ($cat) use ($query) {
                        $cat->where('name', 'like', '%'.$query.'%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories', 'query'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Log::info('Task store attempt', [
            'user_id' => Auth::id(),
            'payload' => $request->except(['images', '_token']),
        ]);

        if (! $request->filled('budget_max')) {
            $request->merge(['budget_max' => $request->budget_min]);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'budget_min' => 'required|numeric|min:0',
                'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
                'budget_type' => 'required|in:fixed,hourly,project',
                'payment_method' => 'required|in:cash,card,online',
                'location' => 'required_if:is_remote,0|string|max:255',
                'urgency' => 'required|in:low,medium,high,urgent',
                'deadline' => 'nullable|date|after:today',
                'required_skills' => 'nullable|array',
                'required_skills.*' => 'string|max:50',
                'images' => 'nullable|array|max:5',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_remote' => 'boolean',
            ]);
        } catch (ValidationException $e) {
            Log::warning('Task store validation failed', [
                'user_id' => Auth::id(),
                'errors' => $e->errors(),
            ]);
            throw $e;
        }

        $taskData = $validated;
        unset($taskData['images'], $taskData['required_skills']);
        $taskData['client_id'] = Auth::user()->id;
        $taskData['status'] = 'open';
        $taskData['applications_count'] = 0;

        if ($request->filled('required_skills')) {
            $taskData['required_skills'] = array_filter($request->required_skills);
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('task_images', 'public');
                $imagePaths[] = $path;
            }
            $taskData['images'] = $imagePaths;
        }

        $task = Task::create($taskData);
        Log::info('Task created successfully', [
            'user_id' => Auth::id(),
            'task_id' => $task->id,
        ]);

        return redirect(localized_route('tasks.show', $task->id))
            ->with('success', 'تم إنشاء المهمة بنجاح!');
    }

    public function edit($locale, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->client_id !== Auth::id()) {
            return redirect(localized_route('tasks.index'))->with('error', 'غير مسموح لك بتعديل هذه المهمة');
        }

        if ($task->status !== 'open') {
            return redirect(localized_route('tasks.show', $task->id))
                ->with('error', 'لا يمكن تعديل المهمة بعد بدء العمل عليها');
        }

        $categories = Category::all();

        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, $locale, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->client_id !== Auth::id()) {
            return redirect(localized_route('tasks.index'))->with('error', 'غير مسموح لك بتعديل هذه المهمة');
        }

        if ($task->status !== 'open') {
            return redirect(localized_route('tasks.show', $task->id))
                ->with('error', 'لا يمكن تعديل المهمة بعد بدء العمل عليها');
        }

        if (! $request->filled('budget_max')) {
            $request->merge(['budget_max' => $request->budget_min]);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
            'budget_type' => 'required|in:fixed,hourly,project',
            'payment_method' => 'required|in:cash,card,online',
            'location' => 'required_if:is_remote,0|string|max:255',
            'urgency' => 'required|in:low,medium,high,urgent',
            'deadline' => 'nullable|date|after:today',
            'required_skills' => 'nullable|array',
            'required_skills.*' => 'string|max:50',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_remote' => 'boolean',
        ]);

        $taskData = $validated;
        unset($taskData['images'], $taskData['required_skills']);

        if ($request->filled('required_skills')) {
            $taskData['required_skills'] = array_filter($request->required_skills);
        } else {
            $taskData['required_skills'] = null;
        }

        if ($request->hasFile('images')) {
            $oldImages = (array) ($task->images ?? []);
            if (! empty($oldImages)) {
                foreach ($oldImages as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('task_images', 'public');
                $imagePaths[] = $path;
            }
            $taskData['images'] = $imagePaths;
        }

        $task->update($taskData);

        return redirect(localized_route('tasks.show', $task->id))
            ->with('success', 'تم تحديث المهمة بنجاح!');
    }

    public function destroy($locale, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->client_id !== Auth::id()) {
            return redirect(localized_route('tasks.index'))->with('error', 'غير مسموح لك بحذف هذه المهمة');
        }

        if ($task->applications_count > 0) {
            return redirect(localized_route('tasks.show', $task->id))
                ->with('error', 'لا يمكن حذف المهمة بعد تلقي طلبات تقديم');
        }

        $images = (array) ($task->images ?? []);
        if (! empty($images)) {
            foreach ($images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $task->delete();

        return redirect(localized_route('tasks.index'))
            ->with('success', 'تم حذف المهمة بنجاح!');
    }

    public function myTasks()
    {
        $user = Auth::user();

        if ($user->role === 'client') {
            $tasks = Task::where('client_id', $user->id)
                ->with(['category', 'assignedTasker', 'applications'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $tasks = Task::whereHas('applications', function ($query) use ($user) {
                $query->where('tasker_id', $user->id);
            })
                ->orWhere('assigned_tasker_id', $user->id)
                ->with(['category', 'client', 'applications'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('tasks.my-tasks', compact('tasks'));
    }

    public function acceptApplication($locale, \App\Models\TaskApplication $application)
    {
        if (! Auth::check() || Auth::user()->role !== 'client') {
            return redirect(localized_route('login'));
        }
        $task = $application->task;
        if (! $task || (int) $task->getAttribute('client_id') !== Auth::id()) {
            return back()->with('error', 'غير مصرح لك بإدارة هذه المهمة');
        }
        $application->update(['status' => 'accepted']);
        $application->task->update([
            'status' => 'assigned',
            'assigned_tasker_id' => $application->tasker_id,
            'assigned_at' => now(),
        ]);
        \App\Models\TaskApplication::where('task_id', $application->task_id)
            ->where('id', '!=', $application->id)
            ->update(['status' => 'rejected']);

        return back()->with('success', 'تم قبول العرض وتعيين المنفذ');
    }

    public function rejectApplication($locale, \App\Models\TaskApplication $application)
    {
        if (! Auth::check() || Auth::user()->role !== 'client') {
            return redirect(localized_route('login'));
        }
        $task = $application->task;
        if (! $task || (int) $task->getAttribute('client_id') !== Auth::id()) {
            return back()->with('error', 'غير مصرح لك بإدارة هذه المهمة');
        }
        $application->update(['status' => 'rejected']);

        return back()->with('success', 'تم رفض العرض');
    }

    public function submitCompletion($locale, $id)
    {
        $task = Task::findOrFail($id);
        if (! Auth::check() || Auth::user()->role !== 'tasker') {
            return redirect(localized_route('login'));
        }
        if ($task->assigned_tasker_id !== Auth::id()) {
            return back()->with('error', 'غير مصرح لك بإدارة هذه المهمة');
        }
        if (! in_array($task->status, ['assigned', 'in_progress'])) {
            return back()->with('error', 'لا يمكن تقديم اكتمال المهمة في هذه الحالة');
        }
        $task->update(['completion_requested_at' => now(), 'status' => $task->status === 'assigned' ? 'in_progress' : $task->status]);

        return back()->with('success', 'تم إرسال طلب إكمال المهمة، بانتظار موافقة العميل');
    }

    public function approveCompletion($locale, $id)
    {
        $task = Task::findOrFail($id);
        if (! Auth::check() || Auth::user()->role !== 'client') {
            return redirect(localized_route('login'));
        }
        if ($task->client_id !== Auth::id()) {
            return back()->with('error', 'غير مصرح لك بإدارة هذه المهمة');
        }
        if (is_null($task->completion_requested_at)) {
            return back()->with('error', 'لا توجد عملية إكمال بانتظار الموافقة');
        }
        $task->update(['status' => 'completed', 'completed_at' => now(), 'completion_requested_at' => null]);
        if ($task->assigned_tasker_id) {
            $existingReview = Review::where('client_id', Auth::id())
                ->where('tasker_id', $task->assigned_tasker_id)
                ->where('task_id', $task->id)
                ->exists();

            if (! $existingReview) {
                return redirect(localized_route('reviews.create', ['tasker' => $task->assigned_tasker_id, 'task' => $task->id]))
                    ->with('success', __('Task completed. Please leave a review.'));
            }
        }

        return back()->with('success', 'تمت الموافقة على إكمال المهمة');
    }

    public function declineCompletion($locale, $id)
    {
        $task = Task::findOrFail($id);
        if (! Auth::check() || Auth::user()->role !== 'client') {
            return redirect(localized_route('login'));
        }
        if ($task->client_id !== Auth::id()) {
            return back()->with('error', 'غير مصرح لك بإدارة هذه المهمة');
        }
        if (is_null($task->completion_requested_at)) {
            return back()->with('error', 'لا توجد عملية إكمال بانتظار الموافقة');
        }
        $task->update(['status' => 'in_progress', 'completion_requested_at' => null]);

        return back()->with('success', 'تم رفض الإكمال وإرجاع المهمة إلى قيد التنفيذ');
    }
}
