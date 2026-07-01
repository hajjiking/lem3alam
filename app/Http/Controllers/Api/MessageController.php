<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Task;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Get messages for a specific task
     */
    public function index(Request $request, $taskId = null)
    {
        $task = $taskId ? Task::find($taskId) : null;

        if ($taskId && ! $task) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        $user = $request->user();

        // Check if user is involved in this task
        if ($task && $task->user_id !== $user->id && ! $task->taskApplications()->where('user_id', $user->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to view messages for this task',
            ], 403);
        }

        $query = Message::query();
        if ($taskId) {
            $query->where('task_id', $taskId);
        }
        $messages = $query
            ->with(['sender:id,name,avatar'])
            ->orderBy('created_at', 'asc')
            ->paginate($request->get('per_page', 20));

        // Mark messages as read for current user
        if ($taskId) {
            Message::where('task_id', $taskId)
                ->where('receiver_id', $user->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'data' => $messages,
            'message' => 'Messages retrieved successfully',
        ]);
    }

    /**
     * Send a message
     */
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content_fr' => 'required_without:content_ar|string|max:5000',
            'content_ar' => 'required_without:content_fr|string|max:5000',
            'attachment' => 'sometimes|file|max:25600',
        ]);

        $task = Task::find($taskId);

        if ($taskId && ! $task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $user = $request->user();

        // Check if user is involved in this task
        if ($task && $task->user_id !== $user->id && ! $task->taskApplications()->where('user_id', $user->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to send messages for this task',
            ], 403);
        }

        // Check if receiver is involved in this task
        $receiverId = $request->receiver_id;
        if ($task && $task->user_id !== $receiverId && ! $task->taskApplications()->where('user_id', $receiverId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Receiver is not involved in this task',
            ], 400);
        }

        $messageData = [
            'task_id' => $taskId,
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'content' => encrypt($request->content_fr ?? $request->content_ar ?? ''),
        ];

        // Handle file attachment
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('message_attachments');
            $messageData['attachments'] = [['path' => $attachmentPath, 'name' => $request->file('attachment')->getClientOriginalName()]];
        }

        $message = Message::create($messageData);
        $message->load(['sender:id,name,avatar', 'receiver:id,name,avatar']);

        event(new \App\Events\MessageSent($message));
        \App\Models\MessageDelivery::create([
            'message_id' => $message->id,
            'transport' => 'rest',
            'status' => 'sent',
            'attempts' => 1,
            'meta' => ['receiver_id' => $receiverId],
        ]);

        return response()->json(['success' => true, 'data' => $message, 'message' => 'Message sent successfully'], 201);
    }

    /**
     * Mark message as read
     */
    public function markAsRead(Request $request, Message $message)
    {
        $user = $request->user();

        if ($message->receiver_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $message->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Message marked as read',
        ]);
    }

    /**
     * Get conversation with a specific user
     */
    public function conversation(Request $request, $userId)
    {
        $user = $request->user();

        $messages = Message::where(function ($q) use ($user, $userId) {
            $q->where('sender_id', $user->id)->where('receiver_id', $userId);
        })
            ->orWhere(function ($q) use ($user, $userId) {
                $q->where('sender_id', $userId)->where('receiver_id', $user->id);
            })
            ->with(['sender:id,name,avatar'])
            ->orderBy('created_at', 'asc')
            ->paginate($request->get('per_page', 20));

        // Mark as read
        Message::where('sender_id', $userId)
            ->where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'data' => $messages,
        ]);
    }

    /**
     * Get conversations list
     */
    public function conversations(Request $request)
    {
        $user = $request->user();

        // Get latest message for each task the user is involved in
        $conversations = Message::select('task_id')
            ->selectRaw('MAX(created_at) as last_message_at')
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->with([
                'task:id,title_fr,title_ar,user_id',
                'task.user:id,name,avatar',
            ])
            ->groupBy('task_id')
            ->orderBy('last_message_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $conversations,
            'message' => 'Conversations retrieved successfully',
        ]);
    }
}
