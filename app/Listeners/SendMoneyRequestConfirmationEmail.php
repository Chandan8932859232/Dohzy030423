<?php

namespace App\Listeners;

use Mail;

use App\Events\MoneyRequestRecieved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Services\EmailService;

class SendMoneyRequestConfirmationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public $email;

    public function __construct(EmailService $email)
    {
        //
        $this->email = $email;
    }

    /**
     * Handle the event.
     *
     * @param  MoneyRequestRecieved  $event
     * @return void
     */
    public function handle(MoneyRequestRecieved $event)
    {
        //send email to confirm reciept of application    
        $this->email->sendMoneyRequestRecievedConfirmationEmail();
  
    }

}
