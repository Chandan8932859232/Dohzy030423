<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/{any?}', function (){
   return view('welcome') ;
})->where('any', '^(?!api\/)[\/\w\.-]*');
*/

Auth::routes(['verify' => true]);


/// login routes ///
Route::get('login','Auth\LoginController@showLoginForm')->name('user.login');
Route::post('login','Auth\LoginController@checkLogin')->name('login.check');


/// registration routes ///
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('user.register');
Route::post('register','Auth\RegisterController@register')->name('check.register');

Route::get('account-create-success','Auth\RegisterController@accountCreateSuccess')->name('account-create.success');

//complete Registration route
// Route::get('complete-user-registration-intro','CompleteUserRegisterController@showCompleteRegistrationRequiredInfo')
//     ->name('register.complete.intro');

// Route::get('complete-user-registration','CompleteUserRegisterController@showCompleteRegistrationForm')
//     ->name('register.complete');

Route::post('complete-registration','CompleteUserRegisterController@processCompleteRegistration')
    ->name('process.complete');

Route::post('complete-registration-africa','CompleteUserRegisterController@processCompleteRegistrationAfrica')
    ->name('process.complete.africa');

    // Route::get('login_out', 'Auth\LoginController@login_out');

    Route::group(['middleware'=>'disable_back_btn'],function () {

        Route::get('complete-user-registration-intro','CompleteUserRegisterController@showCompleteRegistrationRequiredInfo')
            ->name('register.complete.intro');
        Route::get('/user-dashboard',  'UserDashboardController@index')->name('user-dashboard');
        Route::get('/refer-user', 'RecommendUserController@showReferralForm')->name('user.referral');
        Route::get('/user-help-center','UserHelpCenterController@showHelpCenterPage')->name('help-center');
        
        Route::get('change-password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('show-password.form');
        Route::put('change-password', 'Auth\ChangePasswordController@updatePassword' )->name('change.password');
        Route::get('about','PagesController@getAbout')->name('static-pages.about');
        Route::get('contact','ContactController@showForm')->name('contact.us');
        Route::post('contact','ContactController@sendEmail')->name('contact.send');
        Route::get('common-questions','PagesController@getHelp')->name('static-pages.common-questions');
        Route::get('complete-user-registration','CompleteUserRegisterController@showCompleteRegistrationForm')
            ->name('register.complete');
//payment center
Route::get('/payment-center', 'PaymentCenterController@showPaymentCenterForm')->name('payment.center');
//request center
Route::get('/request-center', 'RequestCenterController@showRequestCenterForm')->name('request.center');
Route::get('loan-apply', 'ApplyForFundsController@create')->name('funds-apply.create')->middleware(['profile.complete', 'pay-stub.provide']);
Route::get('/user-profile/{user_id}', 'UserProfileController@showUserInfo')->name('profile.show')->middleware('profile.complete'); 
Route::get('/loan-applications/{user_id}', 'UserApplicationsController@index')->name('user-applications.index');
Route::get('/loan-application/{application_id}/edit', 'UserApplicationsController@edit')->name('user-applications.edit');
Route::put('/loan-applications/{application_id}', 'UserApplicationsController@update')->name('user-application.update');

Route::get('/wallet/{user_id}','WalletController@index')->name('wallet.index');
Route::get('/show-user-generate-referral-code', 'UserReferralCodeController@showUserGenerateReferralCodeForm')->name('user.show-generate-referral-code');

//unpaid loans
Route::get('/unpaid-loans/{user_id}','LoanRepayController@showUnpaidLoans')->name('unpaid.loans');
//upload center routes
Route::get('/upload-center', 'UploadCenterController@showUploadForm')->name('upload.center');
 //Wallet Routes
Route::get('/withdraw-funds','WalletController@showWalletWithdrawForm')->name('wallet.withdraw');
Route::post('/withdraw-funds-handle' , 'WalletController@processWalletWithdrawal')->name('wallet.withdraw-process');
    
//upload center routes

Route::post('/upload-process', 'UploadCenterController@processUploadedFile')->name('upload.process');

});



Route::get('email-verify','Auth\VerificationController@showEmailVerifiedMessage')->name('email.verify');

Route::get('phone-number','CompleteUserRegisterController@showPhoneForm')
    ->name('phone.provide');
Route::post('phone-number-store','CompleteUserRegisterController@storePhoneNumber')
    ->name('check.phone');
Route::post('phone-number-africa','CompleteUserRegisterController@storePhoneNumberAfrica')
    ->name('check.phone.africa');

Route::get('phone-verification-code','CompleteUserRegisterController@showVerificationCodeForm')
    ->name('verification.code');
Route::post('phone-validate-verification-code','CompleteUserRegisterController@validateVerificationCode')
    ->name('validate.verification-code');


Route::get('phone-verification','CompleteUserRegisterController@validateVerificationCode')
    ->name('verify.phone');

//phone number update
Route::post('phone-number-update', 'UserProfileController@updatePhoneNumber')->name('update.phone');
Route::get('phone-verification-code-update','UserProfileController@showUpdatePhoneVerificationCodeForm')->name('update.verification.code');
Route::post('phone-verification-validate-update','UserProfileController@validateVerificationCodeUpdate')->name('update.validate.verification.code');

//upload identification document
Route::get('upload-identification-document','CompleteUserRegisterController@showUploadIdentificationForm')
    ->name('upload.document-form');
Route::post('upload-identification-document','CompleteUserRegisterController@uploadDocument')
    ->name('upload.document');


Route::get('account-verify-complete','CompleteUserRegisterController@accountVerifyComplete')
    ->name('account.complete');

//paystub upload
Route::get('paystub-upload', 'PayStubController@showUploadPayStubForm')->name('pay-stub.upload');
Route::post('paystub-upload-processed', 'PayStubController@processUploadedPayStub')->name('pay-stub.provided');

//apply for funds routes

Route::get('loan-payback-date-show', 'ApplyForFundsController@noInstallmentShowForm')->name('no-installment-loan.show');
Route::post('loan-payback-date', 'ApplyForFundsController@noInstallmentHandle')->name('no-installment-loan.handle');

Route::post('loan-apply-process', 'ApplyForFundsController@store')->name('funds-apply.store');

Route::get('loan-payback-installment-option', 'ApplyForFundsController@installmentRefundOption')->name('installment-refund.option');

Route::get('loan-choose-installment-show', 'ApplyForFundsController@decideInstallmentForm')->name('decide-installment-loan.show');

Route::get('loan-installment-number-show', 'ApplyForFundsController@chooseNumberOfInstallmentForm')->name('choose-number-of-installments.show');


Route::post('loan-apply-save', 'ApplyForFundsController@saveLoanApplication')->name('loan-apply.save');

Route::post('loan-installment', 'ApplyForFundsController@handleInstallmentsRepayment')->name('installment-loan.handle');

Route::get('loan-two-installments', 'ApplyForFundsController@twoInstallmentsDisplayForm')->name('two-installments-choose');
Route::post('loan-two-installments-handle', 'ApplyForFundsController@handleTwoInstallmentsRepayment')->name('two-installment-loan.handle');

Route::get('loan-two-installments-review', 'ApplyForFundsController@twoInstallmentsReview')->name('two-installments-review');

Route::post('loan-three-installments-handle', 'ApplyForFundsController@handleThreeInstallmentsRepayment')->name('three-installment-loan.handle');
Route::get('loan-three-installments-review', 'ApplyForFundsController@threeInstallmentsReview')->name('three-installments-review');


Route::post('loan-installment-number', 'ApplyForFundsController@handleInstallmentsNumber')->name('installment-number.handle');

Route::get('banking-information/{loan_id}', 'BankingInformationController@showBankInfoForm')->name('banking.information');
// Route::post('banking-information-submit','BankingInformationController@storeBankAccountInformation')->name('banking-info.provided');
Route::post('banking-information-update','BankingInformationController@storeBankAccountInformation_update')->name('banking-info.update');


Route::get('bank-account-select', 'BankingInformationController@chooseBankAccount')->name('bank-account.choose');
Route::get('bank-account-selected/{bank_id}', 'BankingInformationController@processChoosenBankAccount')->name('bank-account-choosen.process');

Route::get('loan-terms-and-conditions/{loan_id}','ApplyForFundsController@showLoanTermsAndConditionsForm')->name('loan.terms');
Route::get('loan-terms-accept/{loan_id}','ApplyForFundsController@loanTermsAcceptPage')->name('loan-terms.accept');
Route::get('loan-terms-reject/{loan_id}','ApplyForFundsController@loanTermsRejectPage')->name('loan-terms.reject');

Route::post('application/create', 'ApplyForFundsController@directApplicationType')->name('application-type.display');
Route::post('application-referred/store', 'ApplyForFundsController@storeReferredApplication')->name('application-referred.store');

Route::get('home', 'PagesController@getHome')->name('home');


/** Real estate assistance loan **/
 //real estate ownership status
Route::get('home-ownership-status','RealEstateLoanController@showRealEstateOwnershipStatusForm')->name('real-estate-ownership.status');
Route::post('home-ownership-direct','RealEstateLoanController@directRealEstateAssistance')->name('real-estate-redirect');

  //real estate assist upload prove of ownership routes
Route::get('upload-real-estate-prove', 'RealEstateLoanController@uploadRealEstateOwnershipForm')->name('real-estate-prove');
Route::post('uploaded-real-estate-prove', 'RealEstateLoanController@processUploadedRealEstateOwnershipDoc')->name('real-estate-prove.handle');


  //real estate assist preownership upload routes
Route::get('upload-pre-real-estate-prove', 'RealEstateLoanController@uploadRealEstatePreOwnershipForm')->name('real-estate-pre-owner.prove');


  //real estate assist loan application routes
Route::get('real-estate-loan', 'RealEstateLoanController@showRealEstateAssistLoanForm')->name('real-estate-form');
Route::post('real-estate-loan', 'RealEstateLoanController@processRealEstateAssistLoanForm')->name('real-estate-form.process');
Route::post('real-estate-loan-save', 'RealEstateLoanController@saveRealEstateLoanApplication')->name('real-estate-loan.save');

//review application
//Route::get('review-real-estate-loan', 'RealEstateLoanController@reviewApplication')->name('review-real-estate.loan');

Route::get('unavailable-real-estate-assistance-loan', function (){
    return view('funds-application.real-estate-assist.unavailable-real-estate-loan-note');
})->name('real-estate-form.block');


//normally Auth::routes(); should handle logout. however there was an issue where logout was not working so this
//logout route was added explicitly to make logout to work
// TODO : make logout to work without this route. just have it work with the presence of Auth::route();
Route::get('logout', 'Auth\LoginController@logout')->name('user.logout');

//routing for lang : use to make site multi lingual
Route::get('lang/{locale}', 'LangController@lang');




// static-pages routes ; static-pages in this case is non dynamic content based static-pages
Route::get('/', 'PagesController@getIndex')->name('static-pages.index');
// Route::get('about','PagesController@getAbout')->name('static-pages.about');
Route::get('pricing','PagesController@getPricing')->name('static-pages.pricing');
// Route::get('common-questions','PagesController@getHelp')->name('static-pages.common-questions');
Route::get('personal-loans','PagesController@getPersonalLoansPage')->name('static-pages.personal-loans');
Route::get('business-loans','PagesController@getBusinessLoansPage')->name('static-pages.business-loans');
Route::get('savings','PagesController@getSavingsPage')->name('static-pages.savings');

// contact us routes //
// Route::get('contact','ContactController@showForm')->name('contact.us');
// Route::post('contact','ContactController@sendEmail')->name('contact.send');

//email verification route
//avoid using email/verify path it messes up things



/// login routes ///
Route::get('login','Auth\LoginController@showLoginForm')->name('user.login');
Route::post('login','Auth\LoginController@checkLogin')->name('login.check');



/// change password ///
// Route::get('change-password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('show-password.form');
// Route::put('change-password', 'Auth\ChangePasswordController@updatePassword' )->name('change.password');




/// routes to resources: shortcut
//route for adverts
//Route::resource('advert','AdvertsController');

//Route::resource('posts','PostsController');



//route to test out sns (sending of text messages)
Route::get('/sendSMS/{phone_number}', 'SMSController@sendSMS');
Route::get('/sendTwilioSMS/{phone_number}/{message}', 'TwilioTestController@sendPhoneMessage');

Route::get('/checkNumTwilio', 'TwilioTestController@checkPhoneNumberExistence');
//////



Route::put('/profile-update/{user_id}', 'UserProfileController@updateUserProfileInfo')->name('profile.update');
Route::put('/profile-update/{user_id}/address', 'UserProfileController@updateUserAddressInfo')->name('profile.address-update');

// Route::get('/user-dashboard',  'UserDashboardController@index')->name('user-dashboard');

Route::get('/user-applications/{application_id}', 'UserApplicationsController@show')->name('user-applications.view');

Route::get('/loan-repayments/{loan_id}', 'UserApplicationsController@showLoanRepaymentHistory')->name('repayment-history.view');


Route::get('/loan-application/{application_id}/delete', 'UserApplicationsController@destroy')->name('user-application.delete');

Route::get('/loan-application/{loan_id}/accept', 'UserApplicationsController@userApprove')->name('loan.user-approve');

Route::get('/loan-pay-back/{application_id}', 'LoanRepayController@showLoanPayBackForm')->name('loan.payback');
Route::post('/loan-pay-back/{loan_id}', 'LoanRepayController@processLoanPaymentSubmission')->name('loan-pay-back.handle');
//Route::get('/confirm-loan-pay-back', 'UserApplicationsController@handlePaymentSubmission')->name('loan-pay-back.confirm');


Route::get('loans-waiting-list', function (){
    return view('funds-application.waiting-list-note');
})->name('waiting-list-block.note');



Route::get('/usage-statistics/{user_id}', 'UserProfileController@showUserStats')->name('usage.stats');


// Route::get('/user-help-center','UserHelpCenterController@showHelpCenterPage')->name('help-center');


Route::get('/request-referral-code', 'UserReferralCodeController@showRequestCodeForm')->name('request.referral-code');
Route::post('/request-referral-code', 'UserReferralCodeController@processRequestCode')->name('process.referral-code-request');

//business account request
Route::get('/request-business-account', 'BusinessController@showBusinessAccountRequestForm')->name('request.business-account')->middleware(['profile.complete']);
Route::post('/request-business-account-process', 'BusinessController@processBusinessAccountRequest')->name('process.business-account-request');



Route::post('/user-generate-referral-code', 'UserReferralCodeController@createUserReferralCode')->name('user.generate-referral-code');

//resource(CRUD) routes
Route::resources([
    'applications' => 'ApplyForFundsController',
    'nogroup-apply' =>'NoGroupApplicantController',
    'posts' => 'PostsController'
]);


//confirm application deposit info
Route::get('/deposit-information', 'ApplyForFundsController@showDepositInformationForm')->name('deposit.information');
Route::post('/verify-deposit-email', 'ApplyForFundsController@verifyDepositEmail')->name('verify-deposit.email');
Route::post('/verify-deposit-phone', 'ApplyForFundsController@verifyDepositPhone')->name('verify-deposit.phone');
Route::post('/verify-deposit-email-phone', 'ApplyForFundsController@verifyDepositEmailAndPhone')->name('verify-deposit-phone-email');

//review application
Route::get('/review-application', 'ApplyForFundsController@reviewApplication')->name('review.application');

//Route::post('/confirm-info', 'ApplyForFundsController@checkConfirmationInfo')->name('confirm-deposit.information');

Route::post('/application-complete', 'ApplyForFundsController@applicationFinalize')->name('application.complete');

Route::get('/final-loan-review','ApplyForFundsController@finalLoanReview')->name('final.loan-review');

//user to user recommendation routes
/*
Route::get('/refer-user', 'RecommendUserController@showReferralForm')->name('user.referral');
Route::post('/referral', 'RecommendUserController@handleReferral')->name('referral.handle');
*/


//Tontine Routes
Route::get('/tontine/{user_id}', 'TontineController@index')->name('tontine.index');

Route::get('/tontine-contribute', 'TontineController@showTontineContributionForm')->name('tontine.contribute');
Route::post('/tontine-contribute-handle', 'TontineController@processContribution')->name('process.contribution');

Route::get('/tontine-request', 'TontineController@showRequestTontineMembershipForm')->name('tontine-member.request')->middleware(['profile.complete']);;
Route::post('/tontine-request-process', 'TontineController@processTontineMembershipRequest')->name('tontine-request.process');








// Admin Routes
Route::get('/admin/login', 'Admin\Auth\AdminLoginController@showAdminLoginForm')->name('admin-login.show');
Route::post('/admin/login', 'Admin\Auth\AdminLoginController@handleAdminLoginForm')->name('admin.login');

Route::get('/admin/logout', 'Admin\Auth\AdminLoginController@adminLogOut')->name('admin.logout');

Route::get('/admin/register', 'Admin\Auth\AdminRegisterController@showAdminRegistrationForm')->name('admin.register');
Route::post('/admin/register', 'Admin\Auth\AdminRegisterController@createAdmin')->name('admin.store');

Route::get('/admin', 'Admin\AdminController@getAdminIndex')->name('admin.home');


// investors routes
Route::get('/investor/login', 'Investor\InvestorLoginController@showInvestorLoginForm')->name('investor.login');
Route::post('/investor/login', 'Investor\InvestorLoginController@handleInvestorLogin')->name('investor.login-handle');

Route::get('/investor/register', 'Investor\InvestorRegisterController@showInvestorRegisterForm')->name('investor.register');
Route::get('/investor/dashboard', 'Investor\InvestorDashboardController@showInvestorDashboard')->name('investor.home');

Route::post('/invest', 'Admin\Auth\AdminLoginController@handleAdminLoginForm')->name('admin.login');

/********************************************/


//admin loan approve
Route::get('/admin/loan-approve/{loan_id}', 'Admin\AdminLoanHandleController@showApproveLoanForm')->name('admin.loan-approve');
Route::post('/admin/send-loan-approval', 'Admin\AdminLoanHandleController@adminApproveUserLoan')->name('admin.send-loan-approval');

//view loans
Route::get('/admin/loan-applications', 'Admin\LoansController@index')->name('admin.loans');

//view loan details
Route::get('/admin/loan-details/{loan_id}', 'Admin\AdminLoanHandleController@showLoanDetails')->name('admin.loan-details');

Route::get('/admin/loan-limit/{user_id}', 'Admin\LoansController@showChangeLoanLimitForm')->name('admin.show-change-loan-limit');
Route::post('/admin/loan-limit-change', 'Admin\LoansController@changeLoanLimit')->name('admin.change-loan-limit');

//view users
Route::get('/admin/users', 'Admin\UsersController@index')->name('admin.users');

//change user type
Route::get('/admin/user-change/{user_id}', 'Admin\UsersController@showChangeUserType')->name('admin.show-change-user-type');
Route::post('/admin/user-change', 'Admin\UsersController@changeUserType')->name('admin.change-user-type');


//admin confirm money sent
Route::get('/admin/loan-sent/{loan_id}', 'Admin\AdminLoanHandleController@showLoanSentForm')->name('admin.loan-sent');
Route::post('/admin/loan-sent-inform', 'Admin\AdminLoanHandleController@adminConfirmMoneySent')->name('admin.confirm-loan-sent');

Route::get('/admin/referral-code', 'Admin\ReferralCodeGeneratorController@showReferralCodeGeneratorForm')->name('referral.code');
Route::post('/admin/referral-code', 'Admin\ReferralCodeGeneratorController@saveReferralInfo')->name('save.referral-info');

Route::get('/admin/referral-code-assign', 'Admin\ReferralCodeGeneratorController@showAssignReferralCodeForm')->name('assign.referral-code-form');
Route::post('/admin/referral-code-assign', 'Admin\ReferralCodeGeneratorController@assignReferralCodeToUser')->name('assign.referral-code');

//send out email as admin routes
Route::get('/admin/send-email', 'Admin\SendOutInformationController@showSendEmailForm')->name('show.send-email-form');
Route::post('/admin/send-email', 'Admin\SendOutInformationController@sendEmail')->name('admin.send-email');
//send out text message as admin routes
Route::get('/admin/show-text-form', 'Admin\SendOutInformationController@showSendTextMessageForm')->name('show.send-text-form');
Route::post('/admin/send-text-message', 'Admin\SendOutInformationController@sendTextMessage')->name('admin.send-text');


Route::post('/admin/search-request', 'Admin\SearchController@searchRequest')->name('search.request');

Route::get('/admin/user-profile/{user_id}', 'Admin\UsersController@showUserProfile')->name('admin.show-user-profile');

//Enter loan repayment
Route::get('/admin/make-user-payment/{loan_id}', 'Admin\AdminLoanHandleController@showLoanRepayForm')->name('show.loan-repay-form');
Route::post('/admin/loan-payment-made', 'Admin\AdminLoanHandleController@handleLoanRepayment')->name('handle.loan-repayment');

//Enter loan charge
Route::get('/admin/make-loan-charge/{loan_id}', 'Admin\AdminLoanHandleController@showLoanChargeForm')->name('show.loan-charge-form');
Route::post('admin/loan-charge-made', 'Admin\AdminLoanHandleController@handleLoanCharge')->name('handle.loan-charge');


//Enter loan payment history
Route::get('/admin/make-loan-payment-history/{loan_id}', 'Admin\AdminLoanHandleController@showAdminPaymentHistory')->name('admin.loan-payment-history');
//Route::post('admin/loan-payment-made', 'Admin\AdminLoanHandleController@handleLoanCharge')->name('handle.loan-charge');



/*
Route::get('/admin/employees/', 'Admin\EmployeeController@index')->name('employee.index');
Route::get('/admin/employee/{employeeId}', 'Admin\EmployeeController@show')->name('employee.show');
Route::get('/admin/employee/{employeeId}/update', 'Admin\EmployeeController@update')->name('employee.update');
Route::get('/admin/employee/{employeeId}/delete', 'Admin\EmployeeController@destroy')->name('employee.destroy');
Route::post('/admin/employee/store', 'Admin\EmployeeController@store')->name('employee.store');
*/


Route::resources([
  'groups' => 'Admin\GroupsController',
  'sponsors' => 'Admin\SponsorsController',
]);