<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class WalletWithdrawNotification extends Notification
{

    use Queueable;

    protected $request; //varibale that holds notification info
    public $withdrawalDateTime;
    public $withdrawalAmount;
    public $emailForTransfer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request, $withdrawalAmount, $emailForTransfer, $withdrawalDateTime)
    {
        //
        $this->request = $request;
        $this->withdrawalDateTime = $withdrawalDateTime;
        $this->withdrawalAmount = $withdrawalAmount;
        $this->emailForTransfer = $emailForTransfer;
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
    public function toMail($notifiable){

        $userAccountId  = Auth::user()->account_id;

        return (new MailMessage)

             ->subject('Wallet Withdraw Request')
             ->greeting('Hello Admin')
             ->line('A user has made a request to withdraw funds')
             ->line('The user account ID is : '.$userAccountId.'')
             ->line('The amount is : $'.$this->withdrawalAmount.' ')
             ->line('Email for etransfer is : '.$this->emailForTransfer.' ')
             ->line('The funds were requested at : '.$this->withdrawalDateTime.'')
             ->line('Please login with the link below to view the details')
             ->action('View transaction', url('/admin'))
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
