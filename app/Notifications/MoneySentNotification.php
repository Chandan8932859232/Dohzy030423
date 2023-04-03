<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class MoneySentNotification extends Notification
{
    use Queueable;

    protected $request; //varibale that holds notification info

    public $userLanguage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request, $languageOfApplicant)
    {
        $this->request = $request;
        $this->userLanguage = $languageOfApplicant;
        
        //set language to be used to send mail
        \App::setLocale($this->userLanguage);  
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
        $userIdOfApplicant = DB::table('loans')->where('id', $this->request->loanId)->value('applicant_user_id');
        $clientName = DB::table('users')->where('id', $userIdOfApplicant)->value('firstname');
        $amountSent = $this->request->amountSent;
        $moneyTransferMethod = $this->request->moneyTransferMethod;
        $interacPassword = $this->request->interacPassword;


        return (new MailMessage)
                    ->subject(__('money sent'))
                    ->greeting(__('hello')." "."$clientName" )  
                    ->line(__('amount sent').":"." $$amountSent" )   
                    ->line(__('money transfer method').":"." $moneyTransferMethod")
                    ->line(__('receive money password').":"." $interacPassword")
                    ->line(__('if you do not see money yet please wait at least 1 hour before contacting us'));
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
