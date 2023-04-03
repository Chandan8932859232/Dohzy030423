<?php

namespace App\Events;

use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    //In our UserRegistered event we pass user object to it’s constructor. This object will then pass to the event listener
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */


    public function __construct(User $user)
    {
    //In our UserRegistered event we pass user object to it’s constructor. This object will then pass to the event listener
      $this->user = $user;   

     }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
