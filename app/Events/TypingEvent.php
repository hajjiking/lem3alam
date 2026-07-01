<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TypingEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $senderId;

    public int $receiverId;

    public bool $typing;

    public function __construct(int $senderId, int $receiverId, bool $typing)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->typing = $typing;
    }

    public function broadcastOn()
    {
        $a = min($this->senderId, $this->receiverId);
        $b = max($this->senderId, $this->receiverId);

        return new PrivateChannel('conversation.'.$a.'.'.$b);
    }

    public function broadcastAs()
    {
        return 'typing';
    }
}
