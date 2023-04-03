<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Config;
use Illuminate\Support\Facades\Auth;

class LoanRequestReceivedAdminNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        $adminEmail = config('admin.admin_email');
        $userAccountId  = Auth::user()->account_id;

        return (new MailMessage)
            //->cc($adminEmail)
            ->subject('Loan Request')
            ->greeting('Hello Admin')
            ->line('A user with the account id of '.$userAccountId.' has requested for a loan')
            ->line('Please login with the link below to view the details')
            ->action('View loan request', url('/admin'))
            ->line('Thank you for using our application!');


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
