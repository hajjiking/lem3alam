<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageRead;
use App\Events\TypingEvent;
use App\Http\Controllers\Controller;
use App\Jobs\BroadcastMessageJob;
use App\Models\Message;
use Illuminate\Http\Request;

class RealtimeMessageController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required_without:attachment|string|max:5000',
            'attachment' => 'sometimes|file|max:25600',
        ]);
        $senderId = (int) $request->attributes->get('jwt_user_id');
        if (! $senderId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $attachments = [];
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('message_attachments');
            $attachments[] = ['path' => $path, 'name' => $request->file('attachment')->getClientOriginalName()];
        }
        $message = Message::create([
            'sender_id' => $senderId,
            'receiver_id' => (int) $request->receiver_id,
            'content' => encrypt((string) $request->content),
            'attachments' => $attachments,
            'is_read' => false,
        ]);
        BroadcastMessageJob::dispatch($message->id);

        return response()->json(['success' => true, 'data' => $message], 201);
    }

    public function history(Request $request)
    {
        $request->validate(['with_user_id' => 'required|integer']);
        $uid = (int) $request->attributes->get('jwt_user_id');
        $with = (int) $request->with_user_id;
        $perPage = (int) $request->input('per_page', 25);

        $messages = Message::betweenUsers($uid, $with)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json(['success' => true, 'data' => $messages]);
    }

    public function typing(Request $request)
    {
        $request->validate(['receiver_id' => 'required|integer', 'typing' => 'required|boolean']);
        $uid = (int) $request->attributes->get('jwt_user_id');
        event(new TypingEvent($uid, (int) $request->receiver_id, (bool) $request->typing));

        return response()->json(['success' => true]);
    }

    public function read(Request $request)
    {
        $request->validate(['message_id' => 'required|integer']);
        $uid = (int) $request->attributes->get('jwt_user_id');
        $msg = Message::find((int) $request->message_id);
        if (! $msg || $msg->receiver_id !== $uid) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        $msg->markAsRead();
        event(new MessageRead($msg));

        return response()->json(['success' => true]);
    }
}
