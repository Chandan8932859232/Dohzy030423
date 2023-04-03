<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be resent if the user did not receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/email-verify'; //'/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        //$this->middleware('auth'); //comment this out so that user does not have to be logged in to verify email
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    /* override verify() method from VerifiesEmail trait. the verify() method checks if the currently logged
       in user's id is equal to the ID of the user that is requested to be verified. we do not want to do this so we
       override the method and comment out the section that carries out the above logic
      */
    public function verify(Request $request)
    {
        /*
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        } */

        $user = User::find($request->route('id'));
        auth()->login($user);

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }


    public function showEmailVerifiedMessage()
    {
      return view('user.email-verified-confirm');
    }
}
