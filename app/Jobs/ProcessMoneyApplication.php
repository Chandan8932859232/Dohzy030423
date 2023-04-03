<?php

namespace App\Jobs;

use App\Models\Loan;
use App\Models\User;
use App\Notifications\ApplicationProcessedNotification;
use App\Notifications\LoanRequestReceivedAdminNotification;
use App\Services\LoanService;
use App\Services\PhoneService;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ProcessMoneyApplication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;
    private $applicationId;
    private  $funds;

    public $application;


    /**
     * Create a new job instance.
     * @return void
     */

    public function __construct($application )
    {

        //$this->funds = new LoanService();
        $this->application = $application;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(LoanService $loan)
    {
        //change application status from received to processing
         $loan->changeApplicationStatus($this->application['id'], Loan::APPLICATION_IS_PROCESSING);

         /*
        //log error
        Log::info('Information about application',
            ['user_id' => $this->userId,'application_id' => $this->applicationId,'file' => __FILE__,'line' => __LINE__]);
        */

        //send application processed email
         //$this->email->sendMoneyRequestProcessedEmail();
        //  EmailService::sendMoneyRequestProcessedEmail();

        //send application processed text message
        //PhoneService::sendMoneyRequestProcessedConfirmationByPhone(18195807428);
       /*
        $userEmail = Auth::user()->email; //User::first();

        Log::info('application email is' ,$this->application);

        //$user->notify(new ApplicationProcessedNotification($this->application));

        //send mail notification to admins(on-demand notification)
        Notification::route('mail',$userEmail)
            ->notify(new ApplicationProcessedNotification($this->application));
        */
    }
}
