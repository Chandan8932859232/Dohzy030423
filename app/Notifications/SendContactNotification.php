<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendContactNotification extends Notification
{

    use Queueable;

    //define a protected variable
    protected $request; //varibale that holds notification info

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request) //add request to constructor because it is passed at object instantiation
    {
      $this->request =$request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Someone Contacted Dohzy')
                ->greeting('Hello Dohzy')
                ->line('Someone with the name of '.$this->request->name.' has contacted us')
                ->line('Here is their message')

                ->line($this->request->message)
                ->line('Here is their email : ' .$this->request->email)
                ->line('Here is their phone number : ' .$this->request->phoneNumber)

                //->action('Notification Action', url('/'))
                //->action('Reply', url('mailto:'.$this->request->email))
                ->line('Thank you for using our Service');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
