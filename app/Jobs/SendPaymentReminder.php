<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\PaymentReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendPaymentReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public  function isPaymentDateNear() : bool {
       //if payment date is near  return true else return false
        /*
         //check that user burrowed
          // has not paid back
          // check that payment is due in 5 days

        if( ){
            return true;
        }
        return false;
        */
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*

        $user = User::first();

        $user->notify(new PaymentReminder());

       */
    }
}
