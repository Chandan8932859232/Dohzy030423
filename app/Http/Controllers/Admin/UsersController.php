<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LoanService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{

    public $loanService;


    public function __construct(LoanService $loanService){

        $this->loanService = $loanService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('created_at','desc')->paginate(10);
                 return view('admin.users', compact('users'));
    }

    public function showChangeUserType($userId){

        $userInfo = User::find($userId);

        return view('admin.user-type-change')->with('userInfo', $userInfo);

    }

    public function changeUserType(Request $request){

        //validation
        $this->validate($request, [
         'userId' => 'required',
         'targetUserType' =>'required|numeric']);

         $this->loanService->changeUserType($request->input('userId'), $request->input('targetUserType'));

         return back()->with('success' , 'user type has being changed');
    }


   public function showUserProfile($userId){

     $userInfo = DB::table('users')
     ->where('users.id', '=', $userId)
     ->first();

     $userPhone = DB::table('phones')
     ->where('phones.user_id', '=', $userId)
     ->first();

     $userAddress = DB::table('addresses')
     ->where('addresses.user_id', '=', $userId)
     ->first();

     $userLoanMetrics = DB::table('users_loan_metrics')
     ->where('users_loan_metrics.user_id', '=', $userId)
     ->first();

     $applications = DB::table('loans')
     ->where('loans.applicant_user_id', '=', $userId)->paginate(4);
     //->first();


     return view('admin.user-profile-info')
       ->with('userInfo', $userInfo)
       ->with('userPhone', $userPhone)
       ->with('userAddress', $userAddress)
       ->with('userLoanMetrics', $userLoanMetrics)
       ->with('applications', $applications);

   }



}
