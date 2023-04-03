<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class ApplicationProcessedNotification extends Notification
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
        $this->application = $application;
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
          //    $user = auth()->user();

            $amountRequested = $this->application['application_amount'];
            $approvedAmount = 'NA';
            $interestRate = $this->application['interest_rate'];
            $payBackAmount = $this->application['balance'];
            $payBackDate = $this->application['applicant_proposed_pay_back_date'];

            // Generating URLs...
           // $url = route('profile');

          // $url= route('user-applications.view',$this->application['applicant_user_id']);
          // $url = url('/user-application/'.$this->application['applicant_user_id']);  //url to view loan applications


        $userId = Auth::user()->id;

        $url = route('user-applications.index', ['user_id'=> $userId]);

        return (new MailMessage)
                    ->subject('Loan Request Processed')
                    ->greeting("Hello $username" )
                    ->line('Your Loan request has been processed and here is a brief summary')

                     ->line("Amount Requested:  $$amountRequested")
                    // ->line("Amount Approved:  $$approvedAmount")
                     ->line("Interest Rate:  $interestRate %")
                     ->line("Pay back amount: $$payBackAmount ")
                     ->line("Pay back date: $payBackDate")


                    ->action('View Loan Details', $url)

                    ->line('Please go into your account and approve the loan before we can disburse the funds');
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
