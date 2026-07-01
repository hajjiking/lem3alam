<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get conversations (grouped messages)
        $conversations = Message::where('sender_id', $user->id)
                               ->orWhere('receiver_id', $user->id)
                               ->with(['sender', 'receiver', 'task'])
                               ->orderBy('created_at', 'desc')
                               ->get()
                               ->groupBy(function($message) use ($user) {
                                   // Group by the other participant
                                   return $message->sender_id == $user->id ? $message->receiver_id : $message->sender_id;
                               });
        
        return view('messages.index', compact('conversations'));
    }

    public function show(int $id)
    {
        $user = Auth::user();
        
        // Get conversation with specific user
        $messages = Message::where(function($query) use ($user, $id) {
                              $query->where('sender_id', $user->id)
                                    ->where('receiver_id', $id);
                          })
                          ->orWhere(function($query) use ($user, $id) {
                              $query->where('sender_id', $id)
                                    ->where('receiver_id', $user->id);
                          })
                          ->with(['sender', 'receiver', 'task'])
                          ->orderBy('created_at', 'asc')
                          ->get();
        
        $otherUser = User::findOrFail($id);
        
        // Mark messages as read
        Message::where('sender_id', $id)
               ->where('receiver_id', $user->id)
               ->where('is_read', false)
               ->update(['is_read' => true]);
        
        return view('messages.show', compact('messages', 'otherUser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'task_id' => 'nullable|exists:tasks,id',
            'content' => 'required_without:attachment|string|max:5000',
            'attachment' => 'sometimes|file|max:25600'
        ]);

        $attachments = [];
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('message_attachments');
            $attachments[] = ['path' => $path, 'name' => $request->file('attachment')->getClientOriginalName()];
        }
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'task_id' => $request->task_id,
            'content' => encrypt($request->content),
            'attachments' => $attachments,
            'is_read' => false
        ]);

        \App\Jobs\BroadcastMessageJob::dispatch($message->id);
        return redirect(localized_route('messages.show', $request->receiver_id))
                        ->with('success', 'تم إرسال الرسالة بنجاح!');
    }

    public function reply(Request $request, int $id)
    {
        $request->validate([
            'content' => 'required_without:attachment|string|max:5000',
            'attachment' => 'sometimes|file|max:25600'
        ]);

        $attachments = [];
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('message_attachments');
            $attachments[] = ['path' => $path, 'name' => $request->file('attachment')->getClientOriginalName()];
        }
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $id,
            'content' => encrypt($request->content),
            'attachments' => $attachments,
            'is_read' => false
        ]);

        \App\Jobs\BroadcastMessageJob::dispatch($message->id);
        return redirect(localized_route('messages.show', $id))
                        ->with('success', 'تم إرسال الرد بنجاح!');
    }
}
