<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\ChangeUserPasswordNotification;
use App\Rules\CheckPasswordDifference;
use App\Rules\CheckPasswordExistence;
use App\Rules\CheckPasswordStrength;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ChangePasswordController extends Controller
{
    public function __construct()
    {
        //ensure that only authenticated users can access controller
        $this->middleware('auth');
    }

    public function showChangePasswordForm(){
        return view('user.password-change');
    }

    public function updatePassword(Request $request){

        $validatedData = $request->validate([
            'currentPassword' => ['required',new CheckPasswordExistence],
            'newPassword' => ['required', new CheckPasswordDifference,new CheckPasswordStrength],
            'newPassword_confirmation' => ['required','same:newPassword'],
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('newPassword'));
        $user->save();

        //send email to inform user password change
        $user->notify(new ChangeUserPasswordNotification());

        return redirect()->route('show-password.form')->with("success",__('password changed successfully'));

    }
}
