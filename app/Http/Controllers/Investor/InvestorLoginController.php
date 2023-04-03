<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class InvestorLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
       /*
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:investors')->except('logout'); */
       // $this->middleware('auth:user')->except('logout');


    }

    public function showInvestorLoginForm(){

        return view('investor.login');

    }

    public function handleInvestorLogin(Request $request){

        //validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //store login data
        $user_data = array(
            'email'=> $request->get('email'),
            'password'=> $request->get('password')
        );



        //if validation is successful, it will execute if block otherwise else block
        if(Auth::guard('investor')->attempt($user_data)){

            return redirect()->route('investor.home'); //send to admin homepage
        }
        else{

            // validation failed
            return redirect()->route('investor.login')->withErrors('Wrong login details');
            //return back()->with('error','Wrong login details');
        }
    }


    public function investorLogOut(Request $request){

        Auth::guard('investor')->logout();

        $request->session()->invalidate();

        return redirect()->route('investor.login')->with('status','Investor has been logged out!');

     }




}
