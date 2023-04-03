<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class LoanApprovedNotification extends Notification
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

        $this->request =$request;
        $this->userLanguage = $languageOfApplicant;
         
        //set language to be used to sent mail
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
        $amountApproved = $this->request->amountApproved;
        $sendMoneyTime = $this->request->sendMoneyTime;
        $sendMoneyDate = $this->request->sendMoneyDate;


            //url to view loan applications
        $url = route('user-applications.index', ['user_id'=> $userIdOfApplicant]);

        return (new MailMessage)
                    ->subject(__('loan approved'))
                    ->greeting(__('hello')." "."$clientName" ) 
                    ->line(__('your loan request has been processed and approved.below is some information about the loan'))

                     ->line(__('amount approved').":"." $$amountApproved")
                     ->line(__('money deposit date').":"." $sendMoneyTime "."$sendMoneyDate ")
                     ->line(__('before the money is deposited in your bank account you have to log into our platform and accept the loan'))

                    ->action(__('accept loan'), $url)

                    ->line(__('thank you for choosing Dohzy'));
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
