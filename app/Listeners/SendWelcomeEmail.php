<?php

namespace App\Listeners;

/** */
use Mail;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Auth\Events\Verified;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        //we write the code for sending email in the handle method of our listener. This is the listener method get a call after the event occur.
        $data = array('name' => $event->user->firstname, 'email' => $event->user->email, 'body' => 'Welcome to our website. Hope you will enjoy our articles');

        Mail::send('emails.mail', $data, function($message) use ($data) {
            $message->to($data['email'])
                    ->subject('Welcome to our Website');
            $message->from('noreply@artisansweb.net');
        });
    }
}
