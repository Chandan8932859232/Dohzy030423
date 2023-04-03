<?php

namespace App\Listeners;

use Mail;

use App\Events\MoneyRequestRecieved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\PhoneService;

class SendMoneyRequestConfirmationText
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public $phone; 

    public function __construct(PhoneService $phone)
    {
        //
        $this->phone = $phone;
    }

    /**
     * Handle the event.
     *
     * @param  MoneyRequestRecieved  $event
     * @return void
     */
    public function handle(MoneyRequestRecieved $event)
    {
        // send text message to confirm reciept of application
        $this->phone->sendMoneyRequestRecievedConfirmationByPhone(8195807428);
    } 
}
