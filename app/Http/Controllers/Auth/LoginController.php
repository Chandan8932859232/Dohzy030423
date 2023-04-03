<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    public $user;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
       $this->middleware('guest')->except('logout');

       $this->middleware('guest:admin')->except('logout');
       $this->middleware('guest:investor')->except('logout');

       $this->user = $user;
    }

    //this logout function overrides the original function in the
    //trait AuthenticatesUsers since it is bad practise to touch original laravel source code
    // the main purpose of the function is to redirect the user to custom logout page when they click on logout
    //instead of redirecting them to homepage as defined by the shipped laravel version
    public function logout()
    {



        Auth::logout();
        // return redirect('/login_out');
        return view('user.logout-page')->with('success','You have logged out');   //redirect('/help');

    }
    // public function login_out()
    // {
    //     return view('user.logout-page')->with('success','You have been logged out');  
    // }
    //show form
    public  function showLoginForm (){
        return view('user.login');
        //return view('user.login-new');
    }


    // function to receive login form request
    public function checkLogin (Request $request){

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
        if(Auth::attempt($user_data)){

            if($this->user->isUserProfileComplete()){
                return redirect()->intended('user-dashboard'); //send user to user's homepage
            }
            //send user with incomplete profiles to complete registration page
            return redirect()->route('register.complete.intro')
                             ->with('info', 'Please complete your registration in order to use most of our services');
        }
        else{
            // validation failed
           // return redirect()->route('user.login')->withErrors('Wrong email or password');

          // validation failed
          return back()->withErrors('Wrong email or password');
        }

    }//end checklogin form


}
