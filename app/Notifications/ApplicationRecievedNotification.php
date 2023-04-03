<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class ApplicationRecievedNotification extends Notification
{
    use Queueable;

     public $application;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($application)
    {
        $this->application= $application;
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

        $username = Auth::user()->firstname;

        $userId = Auth::user()->id;

        //url to view loan applications
        $url = route('user-applications.index', ['user_id'=> $userId]);

        return (new MailMessage)
                     ->subject(__('loan request received'))
                    ->greeting(__('hello')." "."$username")
                    ->line(__('your request for a loan has been received. You can visit the link below to see the status of your application'))
                    ->action(__('view loan'), $url)
                    ->line(__('thank you for using Dohzy Inc and Please do not hesitate to contact us with any concerns'));
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
