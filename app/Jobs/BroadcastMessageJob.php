<?php

namespace App\Jobs;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\MessageDelivery;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BroadcastMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $messageId;

    public function __construct(int $messageId)
    {
        $this->messageId = $messageId;
    }

    public function handle(): void
    {
        $message = Message::find($this->messageId);
        if ($message) {
            event(new MessageSent($message));
            MessageDelivery::create([
                'message_id' => $message->id,
                'transport' => 'websocket',
                'status' => 'broadcasted',
                'attempts' => 1,
                'meta' => ['receiver_id' => $message->receiver_id],
            ]);
        }
    }
}
