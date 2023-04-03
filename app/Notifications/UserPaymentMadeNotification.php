<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserPaymentMadeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $loandId;

    public function __construct($request, $loanId)
    {
        $this->request =$request;
        $this->loandId = $loanId;
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

        $userAccountId = Auth::user()->account_id;

        return (new MailMessage)
            ->subject('User Made Payment')
            ->greeting("Hello Admin" )
            ->line("user with account id '$userAccountId' made a payment for loan '$this->loandId' ")
            ->line('Here is the payment information provide by the user')
            ->line('Amount sent : $' .$this->request->amountSent. '')
            ->line('Interac password : ' .$this->request->interacPassword. '')
            ->line('Date Sent : '  .$this->request->sentMoneyDate. '')
            ->action('Go to admin panel for details', url('/login/admin'))
            ->line('Thank you for using our platform!');
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
