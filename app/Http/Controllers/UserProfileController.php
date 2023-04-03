<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use App\Models\Phone;
use Illuminate\Http\Request;
use function App\Services\getBirthDayFromBirthInfo;
use function App\Services\getBirthMonthFromBirthInfo;
use function App\Services\getBirthYearFromBirthInfo;
use function App\Services\monthsEng;
use function App\Services\updateUserAddress;
use function App\Services\countriesData;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\PhoneService;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Session;


class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //middleware to make sure only logged in user can access userProfile
    }

    public function showUserInfo($userId)
    {

        $months = monthsEng();
        $countryInfo = countriesData();

        $userInfo = DB::table('users')
            ->where('users.id', '=', $userId)
            ->first();

        $userPhone = DB::table('phones')
            ->where('phones.user_id', '=', $userId)
            ->first();

        $userAddress = DB::table('addresses')
            ->where('addresses.user_id', '=', $userId)
            ->first();

        $userBank_info = DB::table('bank_account_information')
            ->where('user_id', $userId)
            ->first();

        return view('user.profile')->with('userInfo', $userInfo)
            ->with('userPhone', $userPhone)
            ->with('countryInfo', $countryInfo)
            ->with('userBank_info', $userBank_info)
            ->with('user_id', $userId)

            ->with('userAddress', $userAddress);
    }

    public function updateUserProfileInfo(Request $request, $userId)
    {
        //validate form data
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'language' => 'required',
            'gender' => 'required',
            'birthYear' => 'required',
            // 'yearsInCanada'=> 'required',
            // 'workIndustry' => 'required',
            // 'maritalStatus' => 'required',
            'countryOfOrigin' => 'required',
        ]);

        //update users table data
        $user = new User; //create instance of application model

        //concatenate birth fields to form single birthday string
        $userBirthDate = $request->input('birthDay') . '/' . $request->input('birthMonth') . '/' . $request->input('birthYear');

        //update users information on users table
        $addUserInfo = User::where('id', $userId)
            ->update(
                [
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'language' => $request->input('language'),
                    'gender' => $request->input('gender'),
                    'birth_date' => $request->input('birthYear'),
                    'country_of_origin' => $request->input('countryOfOrigin'),
                ]);

        //update address  table data
        /** TODO: Fix issues when user submits unchanged address */
        // updateUserAddress($userId, $request->input('address'));
        return redirect()->back()
            ->with('userProfileUpdate', 1)
            ->with('message', __('user profile successfully updated'));
    }

    public function updateUserAddressInfo(Request $request, $userId)
    {
        //validate form data
        $this->validate($request, [
            'address' => 'required',
        ]);

        $updated = updateUserAddress($userId, $request->input('address'));

        if ($updated) {
            return redirect()->back()
                ->with('userAddressUpdate', 1)
                ->with('message', __('user address sucessfully updated'));
        } else {
            return redirect()->back()
                ->withErrors('message', __('invalid address format'));
        }

    }

    public function updatePhoneNumber(Request $request, User $user, PhoneService $phone)
    {

        $userId = $user->getUserId();
        $userLanguage = $user->getUserLanguage();
        $countryCode = 1;

        $request->validate([
            'phoneNumber' => 'required|numeric|min:10|unique:phones,phone_number,' . $userId . ',user_id',
        ]);
        $phoneNumber = $request->input('phoneNumber');
        $userPhoneNumber = $phone->cleanUpPhoneNumber($phoneNumber);
        $userPhoneNumber = $phone->addCountryCodeToNumber($countryCode, $userPhoneNumber);

        $phoneVerificationCode = $phone->generatePhoneVerificationCode();
        $phone->sendPhoneVerificationCode($userPhoneNumber, $phoneVerificationCode, $userLanguage);

        $updateUserPhoneInfo = [

            'verification_code' => $phoneVerificationCode,
        ];

        $updateUser = DB::table('phones')->where('user_id', $userId)->where('verification_status', 1)->update($updateUserPhoneInfo);

        if (!$updateUser) {
            return redirect()->back()
                ->with('userPhoneUpdate', 1)
                ->withErrors(__('Phone Number Update Failed'));
        }

        $update_data = [
            'user_id' => $userId,
            'phone_number' => $request->input('phoneNumber'),
            'phone_type' => $request->input('phoneType'),
            // 'verification_code' => $phoneVerificationCode,
            'country_code' => $countryCode,
        ];
        Session::put('update_data', $update_data);

        // $this->showUpdatePhoneVerificationCodeForm($update_data);

        return redirect()->route('update.verification.code');
    }
    public function showUpdatePhoneVerificationCodeForm(User $user)
    {

        $userId = session('update_data')['user_id'];
        $phoneNumber = session('update_data')['phone_number'];
        $phoneType = session('update_data')['phone_type'];
        $countryCode = session('update_data')['country_code'];

        return view('user.phone-update-verification-code')->with([
            'userId' => $userId,
            'phoneNumber' => $phoneNumber,
            'phoneType' => $phoneType,
            'countryCode' => $countryCode,
        ])
            ->with('userPhoneUpdate', 1);
    }

    public function validateVerificationCodeUpdate(Request $request, User $user, Phone $phoneModel, )
    {

        $userId = $user->getUserId();

        //validate verification code
        $request->validate([
            'phoneVerificationCode' => 'required|min:4|max:4',
        ]);

        //compare saved verification code against user verification code
        $savedPhoneVerificationCode = $phoneModel->getUserPhoneVerificationCode($userId); //get saved verification code

        //something went wrong in retrieving verification code from database
        if (!$savedPhoneVerificationCode) {
            //log error
            Log::error('something went wrong in retrieving verification code from database',
                ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);
            return view('user.phone-verification-code')->withErrors([__('something went wrong in the process please contact us')]);
        }

        //get user provided verification code
        $userProvidedPhoneVerificationCode = $request->input('phoneVerificationCode');

        $userId = $request->input('userid');
        $phoneNumber = $request->input('phoneNumber');
        $phoneType = $request->input('phoneType');
        $country = $request->input('countryCode');

        $phone_no_update = [
            'phone_number' => $phoneNumber,
            'phone_type' => $phoneType,
            'country_code' => $country,

        ];

        //compare user provided verification code to saved verification
        // if ($userProvidedPhoneVerificationCode !== $savedPhoneVerificationCode) {
        //     return back()->withErrors([__('the phone verification code you provided does not match with what we have in our records')]);
        // }

        if ($userProvidedPhoneVerificationCode == $savedPhoneVerificationCode) {
            DB::table('phones')->where('user_id', $userId)->update($phone_no_update);

            return redirect()->route('profile.show', ['user_id' => $userId])
                ->with('userPhoneUpdate', 1)
                ->with('message', __('phone number has been successfully updated'));
        }
        // if ($userProvidedPhoneVerificationCode !== $savedPhoneVerificationCode) {
     else{

            return back()->withErrors([__('the phone verification code you provided does not match with what we have in our records')]);
        }
    }

    public function showUserStats()
    {
        return view('user.usage-stats');
    }

}

