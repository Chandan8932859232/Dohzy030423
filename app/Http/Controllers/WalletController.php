<?php

namespace App\Http\Controllers;

use App\Models\WalletTransactions;
use App\Models\Wallet;
use App\Notifications\WalletWithdrawNotification;
use App\Models\User;
use App\Rules\CompareRequestAmountToBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Services\PhoneService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WalletController extends Controller
{

    public $user;


    public function __construct(User $user){

        $this->middleware('auth');

        $this->user = $user;

    }

    public function index($userId){

        $walletTransactions = WalletTransactions::where('user_id', '=', $userId)->orderBy('created_at','desc')->paginate(10);      ;

        return view('wallet.index')->with('walletTransactions' , $walletTransactions);

    }

    public function showWalletWithdrawForm(){

        return view('wallet.withdraw-funds');

    }

    public function processWalletWithdrawal(Request $request , PhoneService $phoneService){

        $request->validate([
         // 'withdrawAmount'=> [ 'required' , 'numeric' , 'min:10', new CompareRequestAmountToBalance ],
          'interactEmail' => 'required',
         ]);

        $currentDateTime = date('Y-m-d H:i:s');
        $withdrawalDateTimeEST = (new \App\Services\DateTimeService)->convertTimeToEST($currentDateTime);

        $withdrawAmount = $request->input('withdrawAmount');

        $emailForTransfer = $request->input('interactEmail');

       //debit wallet balance
          //then add new debit balance to balance in database
        $newWalletBalance = $this->debitWalletBalance($withdrawAmount);


        $walletTransaction = new WalletTransactions;

        $walletTransaction->user_id = $this->user->getUserId();
        $walletTransaction->status  = WalletTransactions::DEBIT_TRANSACTION;
        $walletTransaction->type  = WalletTransactions::TRANSACTION_TO_BE_VERIFIED ;
        $walletTransaction->date = $withdrawalDateTimeEST;
        $walletTransaction->amount =  $withdrawAmount;
        $walletTransaction->balance = $newWalletBalance;

        $walletTransaction->save(); //save info in database

        //send notification text to admin
       if(App::environment(['prod', 'production', 'stage', 'beta', 'dev', 'local'])) {

            $userAccountId = Auth::user()->account_id;


            $phoneService->sendWalletWithdrawRequestMessageToAdmin( config('admin.super_admin_phone_number'), $userAccountId, $withdrawAmount, $emailForTransfer, $withdrawalDateTimeEST);

            //send mail notification to admins(on-demand notification)
            Notification::route('mail', config('admin.super_admin_email'))
                ->notify(new WalletWithdrawNotification($request, $withdrawAmount, $emailForTransfer, $withdrawalDateTimeEST));

      }

        // save request to withdraw funds to database
        DB::table('wallet_withdrawal_request')->insert(
            [
               'user_id' => $this->user->getUserId(),
               'withdrawal_amount' => $request->input('withdrawAmount'),
               'transfer_method' => 1,
               'transfer_email'=>$request->input('interactEmail'),
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'),
             ]);

        return view('wallet.withdraw-complete');

    }


    public function debitWalletBalance($debitAmount){

        //$currentBalance = (new \App\Models\Wallet)->getWalletBalance($this->user->getUserId());

        $currentBalance = (new \App\Models\Wallet)->getWalletBalanceRaw($this->user->getUserId());

        $newBalance = floatval($currentBalance) - floatval($debitAmount);


        //update balance with new balance
        DB::table('wallets')->where('user_id', $this->user->getUserId())->update(['balance'=>$newBalance]);

        return $newBalance;

    }










}
