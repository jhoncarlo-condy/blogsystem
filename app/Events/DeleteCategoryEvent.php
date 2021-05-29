<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DeleteCategoryEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $deletecategory;
    public function __construct($deletecategory)
    {
        $this->deletecategory = $deletecategory;
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
