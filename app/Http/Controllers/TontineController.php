<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\TontineTransactions;
use App\Notifications\UserTontineContributionNotification;
use App\Notifications\UserTontineMembershipRequestNotification;
use App\Services\PhoneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

use Illuminate\Support\Facades\DB;




class TontineController extends Controller
{
    //

    public $user;

    public function __construct(User $user){

        $this->middleware('auth');

        $this->user = $user;

    }

    public function showRequestTontineMembershipForm(){

        return view('user.request-tontine-membership');
    }


    public function processTontineMembershipRequest(Request $request){

           $request->validate([
            'contributionPlan'=> 'required',
            'contributionStartMonth'=> 'required',
            'contributionReceiveMonth'=> 'required',
            'participationPurpose'=>'required'
            ]);


        //Insert request data into database
         DB::table('request_tontine_participation')->insert(
           [
             'user_id' => Auth::user()->id,   //if does not exist create one
             'plan' => $request->input('contributionPlan'),
             'start_month' =>  $request->input('contributionStartMonth'),
             'receive_month' =>  $request->input('contributionReceiveMonth'),
             'purpose' =>  $request->input('participationPurpose'),
             'created_at' => date('Y-m-d H:i:s') ,
             'updated_at' => date('Y-m-d H:i:s')
           ]);


        //send notificationto admin
        if(App::environment(['prod', 'production', 'stage', 'beta', 'dev', 'local']))
        {

            $userAccountId = Auth::user()->account_id;

            //send mail notification to admins(on-demand notification)
            Notification::route('mail', config('admin.super_admin_email'))
                ->notify(new UserTontineMembershipRequestNotification($request));

        }

        return view("user.request-tontine-success");

    }

    public function index($userId){

        //get tontine information
        //$tontineInformation = Tontine::where('user_id', '=', $userId);//->orderBy('created_at','desc')->paginate(8);

        //get tontine informaton
        $tontineInformation = DB::table('tontine_2022_2023')
        ->where('user_id', '=', $userId)
        ->first();

        //get tontine transaction
        $tontineTransactions = DB::table('tontine_transactions')
        ->where('user_id', '=', $userId)->orderBy('created_at','desc')->paginate(12);



        return view('tontine.index')->with('tontineInformation' , $tontineInformation)
                                     ->with('tontineTransactions' , $tontineTransactions);

     }


     public function showTontineContributionForm(){

        return view('tontine.contribute');

     }


     public function processContribution(Request $request, PhoneService $phoneService){

        $request->validate([
            'amountSent'=> 'required' , 'numeric',
            'sentMoneyDate' => 'required',
            'interacPassword' => 'required'
            ]);

        //save transaction to database

        $tontineTransaction = new TontineTransactions;

        $tontineTransaction->id = $this->generateContributionId();
        $tontineTransaction->user_id = Auth::user()->id;
        $tontineTransaction->amount_paid  = $request->input('amountSent');
        $tontineTransaction->contribute_password = $request->input('interacPassword');
        $tontineTransaction->contribute_date = $request->input('sentMoneyDate');
        $tontineTransaction->contribute_status = 1;
        $tontineTransaction->transaction_type = TontineTransactions::CONTRIBUTION_TRANSACTION_TYPE;

        $tontineTransaction->save(); //save info in database

         //send notification text to admin
        if(App::environment(['prod', 'production', 'stage', 'beta', 'dev', 'local']))
        {
            $userAccountId = Auth::user()->account_id;

            $moneyTransferPassword = $request->input('interacPassword');

            $phoneService->sendTontineContributionMessageToAdmin( config('admin.super_admin_phone_number'), $userAccountId , $moneyTransferPassword);

            //send mail notification to admins(on-demand notification)
            Notification::route('mail', config('admin.super_admin_email'))
                ->notify(new UserTontineContributionNotification($request));

        }

        return view('tontine.complete-contribution');

     }


     public function generateContributionId(){

        $contributionId = "CONT".substr(md5(uniqid()),0,4).mt_rand(100, 800);

        if($this->contributionIdExist($contributionId)){

            return $this->generateContributionId(); //if Exist call generate again
        }

        return  $contributionId;
    }

    public function contributionIdExist($contributionId)
    {
        return  TontineTransactions::where('id',$contributionId)->first();
    }


}
