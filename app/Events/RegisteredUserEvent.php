<?php

namespace App\Events;

use App\Mail\WelcomeNewUserMail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisteredUserEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($user)
    {
        $when = now()->addSeconds(3);
        Mail::to($user->email)->later($when, new WelcomeNewUserMail);
    }
}
