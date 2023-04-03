<?php

namespace App\Events;

use App\Models\User;
use App\Models\Loan;


use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MoneyRequestRecieved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $application;
    //public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Loan $application)//, User $user)
    {
        //
        $this->application = $application;
        //$this->user = $user;
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
