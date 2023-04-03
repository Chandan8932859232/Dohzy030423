<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecommendedUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $request; 
    public $language;


    public function __construct($request, $language)
    {
        $this->request =$request;
        $this->language = $language;

        //set language to be used to sent mail
        \App::setLocale($this->language);
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

        $referralCode = Session::get('generatedReferralCode');
        $userName = Auth::user()->firstname;

        return (new MailMessage)
                    ->subject(__('referred to Dohzy'))
                    ->greeting(__('hello')." " .$this->request->firstName  )
                    ->line(__('you were referred to Dohzy by')." ". "$userName". " ". __('to use the Dohzy platform to get a loan'))
                    ->line(__('all you have do is create an account and use the referral code below to apply for a loan'))
                    ->line(__('referral code').": "."$referralCode")
                    ->action(__('register'), url('/register'))
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
