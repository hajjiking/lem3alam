<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageRead implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        $a = min($this->message->sender_id, $this->message->receiver_id);
        $b = max($this->message->sender_id, $this->message->receiver_id);

        return new PrivateChannel('conversation.'.$a.'.'.$b);
    }

    public function broadcastAs()
    {
        return 'message.read';
    }
}
