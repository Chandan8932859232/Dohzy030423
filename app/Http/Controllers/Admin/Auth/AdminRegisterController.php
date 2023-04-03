<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use  App\Services\RegisterService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/** */
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;


class AdminRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

   // use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = '/admin/register';

    public $register;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegisterService $register)
    {
        $this->middleware('guest');
        $this->register = $register;

    }


    public function showAdminRegistrationForm()
    {
        return view('admin.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createAdmin(Request $request)
    {

        $this->validate($request, [
            'adminFirstName' => 'required|string|max:50',
            'adminLastName' => 'required|string|max:50',
            'adminEmail' => 'required|string|email|max:100|unique:admins,email',
            'adminPhoneNumber' => 'required|max:20',
            'adminAddress' => 'required|max:50',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'id' => $this->register->generateUniqueUserId(),
            'admin_first_name' => $request['adminFirstName'],
            'admin_last_name' => $request['adminLastName'],
            'email' => $request['adminEmail'],
            'admin_phone_number' => $request['adminPhoneNumber'],
            'password' => Hash::make($request['password']),
            'admin_role' => 1,
            'admin_status' => 1,

        ]);

        return redirect()->route('admin-login.show')->with('success', 'Admin has been created you can now log in');

    }

}
