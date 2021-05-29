<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DeletePostEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $deletepost;
    public function __construct($deletepost)
    {
        $this->deletepost = $deletepost;
    }
    public function broadcastOn()
    {
        return new Channel('my-channel');
    }
    public function broadcastAs()
    {
        return 'delete-category-event';
    }
}
