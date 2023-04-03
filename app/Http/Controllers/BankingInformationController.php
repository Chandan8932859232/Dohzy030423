<?php

namespace App\Http\Controllers;

use App\Models\BankAccountInformation;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use App\Services\LoanService;

class BankingInformationController extends Controller
{
    //
    public $bankAccount;
    public $user;
    public $loanService;

    public function __construct( User $user, BankAccountInformation $bankAccount, LoanService $loanService)
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->bankAccount = $bankAccount;
        $this->user = $user;
        $this->loanService = $loanService;
    }

    public function  showBankInfoForm($loanId){
        
        if($this->bankAccount->isBankingAccountInfoPresent($this->user->getUserId())){

            Session::put('userLoanId', $loanId);  //create loanId session and store loanId from url to use it through the banking process

            return redirect()->route('bank-account.choose')->with('info', __('you already have a bank account on file'));
        }

        return view('user.banking-information');
    }

    public function chooseBankAccount(){

        //get user stored banking information
        $userBankAccounts = BankAccountInformation::where('user_id', $this->user->getUserId())->orderBy('created_at','desc')->paginate(9);
        
        return view('user.choose-bank-account')->with('userBankAccounts', $userBankAccounts);
   
    }

    public function processChoosenBankAccount($bankAccountId){

        $loanId = Session::get('userLoanId');  // get loanId that was stored in session

        //insert bank account id to loans table against loan in question
        $this->addBankInfoToLoanInfo($loanId, $bankAccountId); 
      
        return redirect()->route('loan.terms', ['loan_id'=>$loanId])->with('info', __('your bank account was successfully selected.The last step is to accept or reject the terms and conditions'));;
    
    }

    public function storeBankAccountInformation(Request $request)
    {
        //validate info
        $request->validate([
            'institutionNumber' => 'required|digits:3',
            'transitNumber' => 'required|digits:5',
            'accountNumber' => 'required|digits_between:7,12',
            'voidChequeImage'=>'required|mimes:jpeg,jpg,png,pdf|max:7000',
        ]);

        

        //retrieve loanId value
         $loanId = Session::get('loanId');
         
         //loanId does not exist. in cases were session variable no longer exist because  user is supplying banking information later
         if($loanId==null){
           $loanId = basename(url()->previous());
         }

         $bankAccountId =  $this->loanService->generateBankAccountId();  //generate bank account id

         $userId = (new \App\Models\User)->getUserId();
        
         $userAccountId = (new \App\Models\User)->getUserAccountId();

         

        /**TODO : make this possible only when they are providing bank info to confirm a loan 
         * OR maybe add this step when they choose which bank account to use */
           
          // if user has no bank account in system
        if(!$this->bankAccount->isBankingAccountInfoPresent($this->user->getUserId())){

           //add banking information to loan on loans table (tag the bank account to the loan)
           $this->addBankInfoToLoanInfo($loanId, $bankAccountId);  
         }

        // if(App::environment(['prod', 'production'])) {
        //     $bankInfoImage = $request->file('voidChequeImage')->store('bank-documents', 's3');
        //   }
        // else{
        //   $bankInfoImage = $request->file('voidChequeImage')->store('test-bank-documents', 's3');
        // }
        // $bankInfoUrl = Storage::disk('s3')->url($bankInfoImage);

        if(App::environment(['prod', 'production'])) {
            $bankInfoImage = $request->file('voidChequeImage')->store('bank-documents');
          }
        else{
          $bankInfoImage = $request->file('voidChequeImage')->store('test-bank-documents');
        }
        $bankInfoUrl = Storage::disk()->url($bankInfoImage);



        //store the information
        $bankAccountInfo = new BankAccountInformation;

        $bankAccountInfo->id = $bankAccountId;
        $bankAccountInfo->user_id = $userId;
        $bankAccountInfo->institution_number = $request->input('institutionNumber');
        $bankAccountInfo->transit_number = $request->input('transitNumber');
        $bankAccountInfo->account_number = $request->input('accountNumber');
        $bankAccountInfo->void_cheque = $bankInfoUrl;

        $bankAccountInfo->save();  // save bank information to database
       

        //update bank_info status on users table
        User::where('id', $userId)->update(['bank_info_provided_status' => 1]);
  
        return redirect()->route('loan.terms', ['loan_id'=>$loanId])->with('info', __('your bank account information was successfully submited the last step is to accept or reject the terms and conditions'));
           
    }

    public function storeBankAccountInformation_update(Request $request)
    {
    
        //validate info
        $request->validate([
            'institutionNumber' => 'required|digits:3',
            'transitNumber' => 'required|digits:5',
            'accountNumber' => 'required|digits_between:7,12',
            'voidChequeImage'=>'required|mimes:jpeg,jpg,png,pdf|max:7000',
        ]);

        if(App::environment(['prod', 'production'])) {
            $bankInfoImage = $request->file('voidChequeImage')->store('public/bank-documents');
          }
        else{
          $bankInfoImage = $request->file('voidChequeImage')->store('public/test-bank-documents');
        }
        $bankInfoUrl = Storage::disk()->url($bankInfoImage);

       
        $abcd=$request->input('user_id');
    

        //store the information
        $user = new BankAccountInformation;
    
    

        // $bankAccountInfo->save();

   $bankAccountInfo=
   [ 
    'institution_number' => $request->input('institutionNumber'),
       'transit_number' => $request->input('transitNumber'),
       'account_number' => $request->input('accountNumber'),
        'void_cheque' => $bankInfoUrl
   ];
DB::table('bank_account_information')->where('user_id',$abcd)->update($bankAccountInfo);
return redirect()->back()->with('info', __('your bank account information was successfully submited'));
        // return redirect()->route('loan.terms', ['loan_id'=>$loanId])->with('info', __('your bank account information was successfully submited the last step is to accept or reject the terms and conditions'));
         
    }








    public function addBankInfoToLoanInfo($loanId, $bankAccountId){
 
       DB::table('loans')->where('id',$loanId)->update( ['account_to_debit' =>$bankAccountId] );

    }



}
