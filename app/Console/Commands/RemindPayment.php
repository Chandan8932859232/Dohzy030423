<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\PaymentReminder;
use App\Jobs\SendPaymentReminder;
use Illuminate\Console\Command;

class RemindPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemindPayment:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
        $user = User::first();
        $user->notify(new PaymentReminder());
        */

        //SendPaymentReminder::dispatch();
    }
}
