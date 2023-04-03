<?php

namespace App\Http\Controllers;

use App\Services\PhoneService;

use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

use App\Models\User;
use App\Models\Address;
use App\Models\Phone;
use App\Models\Loan;
use App\Models\IdentityDocument;
use Illuminate\Support\Facades\Storage;
use function App\Services\monthsEng;
use function App\Services\countriesData;
 

use Faker\Provider\Image;


class CompleteUserRegisterController extends Controller
{

    public $phone;
    //public $user;
    //public $userId;

    public function __construct(PhoneService $phone)
    {
        $this->middleware(['auth','verified']);
        $this->phone = $phone;
        //$this->user = $user;
        //$this->userId = $this->user->getUserId();

    }

    public function showCompleteRegistrationRequiredInfo(){

        //return redirect()->route('register.complete.intro');
        return view('user.complete-user-register-requirements');

    }

    public  function showCompleteRegistrationForm (User $user , Address $address){



       if(!$user->isUserProfileComplete()) {

           $userType = $user->getUserType();
           $userId = $user->getUserId();

           /**TODO: make code sensitive to language**/
           // $months = monthsEng();
           $countryInfo = countriesData();

           if($userType==User::AFRICA_USER){
               return view('user.africa.complete-registration')->with('countryInfo', $countryInfo);;
           }

          //check if address already exist
           $userAddress = Address::where('user_id', $userId)->value('address_info');

           //if it does not exist start account completion by asking for address
           if(is_null($userAddress) || empty($userAddress)) {

               return view('user.complete-user-register')->with('countryInfo', $countryInfo);
           }

          //but if address exist start account completion by asking for phone or identity doc
          if(!is_null($userAddress) || !empty($userAddress)) {

                  //if phone number is not verified commence the process
               if ( !(new \App\Models\Phone)->phoneNumberVerificationStatus($userId) ){
                   return view('user.phone-number');
               }
                 // if identification document is not upload start the process of asking
               if (!(new \App\Models\IdentityDocument)->identifyDocumentUploadStatus($userId)){
                   return view('user.upload-identification-document');
               }

           }

       }

           return redirect()->route('user-dashboard');
    }


    public  function processCompleteRegistration (Request $request, User $user, RegisterService $register)
    {


        //validate form data
        $this->validate($request, [
            'birthYear' => 'required',
            'yearsInCanada'=>'required',
            'workIndustry'=>'required',
            'maritalStatus'=>'required',
            'countryOfOrigin'=>'required',
            'address' => 'required',
        ]);

        $userId = $user->getUserId();

        //if user profile is not complete then complete it
        if(!$user->isUserProfileComplete()) {

            /** Handle gender, ethnicity , birth_date provided by user , also add user to loans waiting list**/

            //concatenate birth fields to form single birthday string
            $userBirthDate = $request->input('birthDay') . '/' . $request->input('birthMonth') . '/' . $request->input('birthYear');

            //update users information on users table
            $addUserInfo = User::where('id', $userId)
                ->update(
                    [
                        'birth_date' => $request->input('birthYear'),
                        'country_of_origin' => $request->input('countryOfOrigin'),
                        'work_industry' => $request->input('workIndustry'),
                        'years_in_canada' => $request->input('yearsInCanada'),
                        'marital_status' => $request->input('maritalStatus'),
                    ]);

            if (!$addUserInfo) {
                //log error
                Log::error('Insert of gender, ethnicity, birthdate to datatabase failed during profile complete.',
                    ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);

                //inform user of error
                return redirect('/complete-user-registration ')
                    ->with('error', __('unfortunately we could not complete your profile please contact us'));
            }

            /** Handle address provided by user **/

            $userAddressInfo = explode(",", $request->input('address'));
            // dd($userAddressInfo);
            

            $userFullAddress =     $userAddressInfo[0];
            $userAddressCity = $userAddressInfo[1];

            $userAddressProvince = $userAddressInfo[0];
            $userAddressCountry =  $userAddressInfo[1];




            //$userPostalCode = $request->input('postalCode');

            //update or create address in address table
            // If there is address information update if not create one with data from form.
            $addUserAddressInfo = Address::updateOrCreate(
                ['user_id' => $userId],  //check for an existing record
                ['user_id' => $userId,   //if does not exist create one
                    'address_info' => $userFullAddress,
                    'city' => $userAddressCity,
                    'province' => $userAddressProvince,
                    'country' => $userAddressCountry,
                    //'postal_code' => $userPostalCode,
                ]);

            if (!$addUserAddressInfo) {
                //log error
                Log::error('Insert address to addresses table failed during profile complete',
                    ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);

                //inform user of error
                return redirect('/complete-user-registration ')
                    ->with('error', __('unfortunately we could not complete your profile please contact us'));
            }

            //if other info and address were updated successfully
            //change profile_complete_status in the database from 0 to 1

            if (($addUserInfo && $addUserAddressInfo )) {

                if((new \App\Models\User)->isMvpUser($userId)) {
                    return redirect()->route('funds-apply.create')->with('success', 'Profile completed');
                }


                if((new \App\Models\Phone)->phoneNumberVerificationStatus($userId) &&

                    (new \App\Models\IdentityDocument)->identifyDocumentUploadStatus($userId)
                ){

                    $register->completeUserRegistration($userId);  //complete registration

                    return  redirect()->route('account.complete');
                }



                return redirect()->route('phone.provide')->with('info', __('please provide a phone number to complete your profile'));

            }


          //if user gets to form and is able to submit complete registration form even though registration is complete
          //log error
          Log::error('User was able to submit complete registration form even though registration is complete ',
              ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);

          //inform user
          return redirect('/complete-user-registration ')
              ->with('warning', __('based on our records your profile is already complete'));
        }

    }



    public  function processCompleteRegistrationAfrica (Request $request, User $user)
    {
        //validate form data
        $this->validate($request, [
            'gender' => 'required',
            'birthYear' => 'required',
            'countryOfResidence' => 'required',
            'province'=>'required',
            "city" => 'required'
        ]);

        $userId = $user->getUserId();

        //if user profile is not complete then complete it
        if(!$user->isUserProfileComplete()) {

            /** Handle gender, ethnicity , birth_date provided by user **/


            //update users information on users table
            $addUserInfo = User::where('id', $userId)
                ->update(
                    [
                        'gender' => $request->input('gender'),
                        'birth_date' => $request->input('birthYear'), //$userBirthDate,
                        'country_of_origin' => $request->input('countryOfOrigin'),
                    ]);

            if (!$addUserInfo) {
                //log error
                Log::error('Insert of gender, ethnicity, birthdate to datatabase failed during profile complete.',
                    ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);

                //inform user of error
                return redirect('/complete-user-registration ')
                    ->with('error', 'Unfortunately we could not complete your profile please contact us');
            }

            /** Handle address provided by user **/



            //update or create address in address table

            // If there is address information update if not create one with data from form.
            $addUserAddressInfo = Address::updateOrCreate(
                ['user_id' => $userId],  //check for an existing record
                ['user_id' => $userId,   //if does not exist create one
                    'address_info' => $request->input('address'),
                    'city' => $request->input('city'),
                    'province' => $request->input('province'),
                    'country_code' => $request->input('countryOfResidence'),
                ]);

            if (!$addUserAddressInfo) {
                //log error
                Log::error('Insert address to addresses table failed during profile complete',
                    ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);

                //inform user of error
                return redirect('/complete-user-registration ')
                    ->with('error', 'We could not complete your profile,
                           something is wrong with the address. please contact us or try again');
            }

            //if other info and address were updated successfully
            //change profile_complete_status in the database from 0 to 1

            if (($addUserInfo && $addUserAddressInfo )) {

                User::where('id', $userId)
                    ->update(['profile_complete_status' => 1]);

                if((new \App\Models\User)->isMvpUser($userId)) {
                    return redirect()->route('funds-apply.create')->with('success', 'Profile completed');
                }

                return redirect()->route('phone.provide')->with('info', 'Additional information received. Please provide a phone number');
            }

            //if user gets to form and is able to submit complete registration form even though registration is complete
            //log error
            Log::error('User was able to submit complete registration form even though registration is complete ',
                ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);

            //inform user
            return redirect('/complete-user-registration ')
                ->with('warning', 'Based on our records, your profile is already complete');
        }

    }



    public function showPhoneForm(){

        if((new \App\Models\User)->getUserType() == User::AFRICA_USER) {
            return view('user.africa.phone-number');
        }

        return view('user.phone-number');
    }

    public function storePhoneNumber(Request $request, User $user){

        $userId = $user->getUserId();
        $userLanguage = $user->getUserLanguage();
        $countryCode = 1;

        //validate phone number
        $request->validate([
            'phoneNumber'=>'required|numeric|min:10',
        ]);
  

        $phoneNumber = $request->input('phoneNumber');
   
        //clean up phone number
          $userPhoneNumber = $this->phone->cleanUpPhoneNumber($phoneNumber);


        //add country code to phone number
          $userPhoneNumber= $this->phone->addCountryCodeToNumber($countryCode, $userPhoneNumber);

 
        /**TODO: verify that phone number exist, and its active **/
        //generate verification code
        // $phoneVerificationCode = $this->phone->generatePhoneVerificationCode();
        $phoneVerificationCode = "1212";

        //send verification code to user
        $this->phone->sendPhoneVerificationCode($userPhoneNumber, $phoneVerificationCode, $userLanguage);
      
        //add phone information  and verification code to phone table
        $addUserPhoneInfo = Phone::UpdateOrcreate(
            ['user_id' => $userId],  //check for an existing record
            ['user_id' => $userId,   //if does not exist create one
                'phone_number' => $request->input('phoneNumber'),
                'phone_type' => $request->input('phoneType'),
                'verification_code' => $phoneVerificationCode,
                'country_code'=> $countryCode,
            ]);

        if(!$addUserPhoneInfo){
            /**TODO: return back to form and let user know there was an error **/
            //log error
            Log::error('Insert phone info on phones table failed info failed',
                ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);
        }

        //return verification code view
        return redirect()->route('verification.code');

    }


    public function storePhoneNumberAfrica(Request $request, User $user){

        $userId = $user->getUserId();
          //$countryCode = 1;

        //validate phone number
        $request->validate([
            'phoneNumber'=>'required|numeric|min:10',
        ]);

        $phoneNumber = $request->input('phoneNumber');

        //clean up phone number
        $userPhoneNumber = $this->phone->cleanUpPhoneNumber($phoneNumber);

        //add country code to phone number
          //$userPhoneNumber= $this->phone->addCountryCodeToNumber($countryCode, $userPhoneNumber);


        /**TODO: verify that phone number exist, and its active **/
        //generate verification code
           $phoneVerificationCode = $this->phone->generatePhoneVerificationCode();

        //send verification code to user
           //$this->phone->sendPhoneVerificationCode(/*18195807428*/ $userPhoneNumber, $phoneVerificationCode);

        //add phone information  and verification code to phone table
        $addUserPhoneInfo = Phone::UpdateOrcreate(
            ['user_id' => $userId],  //check for an existing record
            ['user_id' => $userId,   //if does not exist create one
                'phone_number' => $request->input('phoneNumber'),
                'phone_type' => $request->input('phoneType'),
                'verification_code' => $phoneVerificationCode,
                 // 'country_code'=> $countryCode,
            ]);

        if(!$addUserPhoneInfo){
            /**TODO: return back to form and let user know there was an error **/
            //log error
            Log::error('Insert phone info on phones table failed info failed',
                ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);
        }


            return view('user.africa.upload-identification-document');

    }



    public function showVerificationCodeForm(){

        return view('user.phone-verification-code');

    } 

   public function validateVerificationCode(Request $request, User $user, Phone $phoneModel){

       $userId = $user->getUserId();

       //validate verification code
       $request->validate([
           'phoneVerificationCode'=>'required|min:4',
       ]);

        //compare saved verification code against user verification code

        //get saved verification code
         $savedPhoneVerificationCode =  $phoneModel->getUserPhoneVerificationCode($userId);

           //something went wrong in retrieving verification code from database
          if(!$savedPhoneVerificationCode){
              //log error
              Log::error('something went wrong in retrieving verification code from database',
                  ['id' => $userId, 'file' => __FILE__, 'line' => __LINE__]);
              return view('user.phone-verification-code')->withErrors( [__('something went wrong in the process please contact us')]);
          }

         //get user provided verification code
          $userProvidedPhoneVerificationCode = $request->input('phoneVerificationCode');

        //compare user provided verification code to saved verification
        if($userProvidedPhoneVerificationCode!==$savedPhoneVerificationCode){
            return back()->withErrors( [__('the phone verification code you provided does not match with what we have in our records')]);
        }

        Phone::where('user_id', $userId)->update(['verification_status' => 1]);

        /** TODO: ensure that flash message of success appears at the top of the view */

       //if identity document has not being uploaded, send user to identity upload form
       if( ! (new \App\Models\IdentityDocument)->identifyDocumentUploadStatus($userId)) {
           return redirect()->route('upload.document-form')->with('info', __('your Phone number has been verified.Please upload an identification document for security purposes'));
       }

         (new \App\Services\RegisterService)->completeUserRegistration($userId);

         return  redirect()->route('account.complete')->with('info', __('phone number has been successfully verified'));
   }


   public function showUploadIdentificationForm(){

        if((new \App\Models\User)->getUserType()== User::AFRICA_USER){

            return view('user.africa.upload-identification-document');

        }

        return view('user.upload-identification-document');

   }

    public function uploadDocument(){

        $request = Request();

        //validate phone number
        $request->validate([
            'image'=>'required|mimes:jpeg,jpg,png,pdf,svg|max:7000',

        ]);

        $userId = (new \App\Models\User)->getUserId();


        //store uploaded files
        //stores uploaded file and returns
        if(App::environment(['prod', 'production'])) {
            $identificationDocument = $request->file('image')->store('identification-documents', 's3');
          }
        else{
            $identificationDocument = $request->file('image')->store('test-identification-documents', 's3');
         }

         $documentUrl = Storage::disk('s3')->url($identificationDocument);

        //save file (document) info to database table
        DB::table('identification_documents')->insert(
               ['user_id' => $userId, 'document_url' => $documentUrl]
        );

        //update identity_doc_upload status on users table
        User::where('id', $userId)->update(['identity_doc_upload_status' => 1]);

        /*
        $image = Image::create([
            'filename' => basename($identificationDocument),
            'url' => Storage::disk('s3')->url($identificationDocument)
        ]); */

       // return Storage::disk('s3')->response('identification-documents/' . $image->filename);



        /*
        $val = Validator:make($request->all, [
            'imgUpload1' => 'required',
        ]);

        if($val->fails()) {
            return redirect()->back()->with(['message' => 'No file received']);
        }
        else {
            $file = $request->file('imgUpload1')->store('images');
            return redirect()->back();
        } */

        (new \App\Services\RegisterService)->completeUserRegistration($userId);

        return  redirect()->route('account.complete')->with('info', __('verification document has been sent'));

    }

    public function accountVerifyComplete(){

        return view('user.account-verify-success');

    }

}
