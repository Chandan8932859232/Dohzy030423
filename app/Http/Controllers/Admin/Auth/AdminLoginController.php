<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:investor')->except('logout');
        $this->middleware('auth:user')->except('logout');

    }

    public function showAdminLoginForm(){
        return view('admin.login');
    }

    public function handleAdminLoginForm(Request $request){
        //validate form data
        $this->validate($request, [
            'adminEmail' => 'required|email',
            'adminPassword' => 'required|min:6'
        ]);

        //store login data
        $user_data = array(
            'email'=> $request->get('adminEmail'),
            'password'=> $request->get('adminPassword')
        );

        //if validation is successful, it will execute if block otherwise else block
        if(Auth::guard('admin')->attempt($user_data)){
            return redirect()->route('admin.home'); //send to admin homepage
        }
        else{

            // validation failed
            return redirect()->route('admin-login.show')->withErrors('Wrong login details');
            //return back()->with('error','Wrong login details');
        }
    }


    public function adminLogOut(Request $request){

      //$this->guard('admin')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        return redirect()->route('admin-login.show')->with('status','Admin has been logged out!');

     }




}
