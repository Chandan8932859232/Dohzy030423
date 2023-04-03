<?php
namespace App\Services;

use Twilio\Rest\Client;
use App\Models\User;

class PhoneService
{

//twilio authentication credentials
    public $twilioSid;
    public $twilioAuthtoken;
    public $twilioNumber;

    public $client;
    public $user;

    public function __construct(User $user)
    {
        $this->twilioSid = getenv("TWILIO_SID");
        $this->twilioAuthtoken = getenv("TWILIO_AUTH_TOKEN");
        $this->twilioNumber = getenv("TWILIO_NUMBER");
        $this->client = new Client($this->twilioSid, $this->twilioAuthtoken);    //instantiate twilio for use

        $this->user = $user;
    }


    /*
    public static function sendMoneyRequestProcessedConfirmationByPhone($recipientPhoneNumber){

     $message = $this->client->messages->create($recipientPhoneNumber,[ "from" =>$this->twilioNumber,"body" =>"Hello, your application for money has been processed!!!! "] );

   } */


    public function sendMoneyRequestReceivedConfirmationByPhone($recipientPhoneNumber)
    {

        $message = $this->client->messages->create($recipientPhoneNumber, ["from" => $this->twilioNumber, "body" => "Hello, your application has been received!!!! "]);

    }

    public function sendLoanApprovedMessageByPhone($recipientPhoneNumber, $languageOfApplicant, $sendMoneyDate, $sendMoneyTime)
    {

        if ($languageOfApplicant == 'en') {
            $message = $this->client->messages->create($recipientPhoneNumber,
                ["from" => $this->twilioNumber,
                    "body" => "Hello, Your loan request has been approved. Please log into our platform and accept the loan. Once that is done.The funds will be deposited in your bank account by $sendMoneyTime on $sendMoneyDate"
                ]);
        }

        if ($languageOfApplicant == 'fr') {
            $message = $this->client->messages->create($recipientPhoneNumber,
                ["from" => $this->twilioNumber,
                    "body" => "Bonjour, Votre demande de prêt a été approuvée. Veuillez vous connecter à notre plateforme et accepter le prêt. Une fois cela fait, les fonds seront déposés sur votre compte bancaire vers $sendMoneyTime le $sendMoneyDate"
                ]);
        }

    }


    public function sendMoneySentMessageByPhone($recipientPhoneNumber, $languageOfApplicant, $amountSent, $moneyTransferMethod, $moneyTransferPassword)
    {

        if ($languageOfApplicant == 'en') {

            $message = $this->client->messages->create($recipientPhoneNumber,
                ["from" => $this->twilioNumber,
                    "body" => "Hello, The loan you requested has been sent.\nAmount sent: $$amountSent \nMethod of transfer: $moneyTransferMethod \nPassword: $moneyTransferPassword\nPlease wait for at least an hour before contacting us if you do not see the money\nThanks for choosing Dohzy."
                ]);
        }

        if ($languageOfApplicant == 'fr') {

            $message = $this->client->messages->create($recipientPhoneNumber,
                ["from" => $this->twilioNumber,
                    "body" => "Bonjour, Le prêt que vous avez demandé a été envoyé.\nMontant envoyé: $$amountSent \nMode de transfert: $moneyTransferMethod \nMot de passe: $moneyTransferPassword \nSi vous ne recevez pas les fonds, veuillez attendre au moins 1 heure avant de nous contacter.\nMerci d'avoir choisi Dohzy."
                ]);

        }


    }


    public function sendRecommendationMessageToReferredUser($phoneNumber, $referralCode, $language, $referrerName)
    {

        if ($language == 'en') {

            $message = $this->client->messages->create($phoneNumber,
                ["from" => $this->twilioNumber,
                    "body" => "Hello, you were referred to Dohzy by $referrerName\nTo use the Dohzy platform to get a loan, All you have do is create an account and use the referral code below to apply for a loan.\nReferral code: $referralCode\nPlease do not hesitate to contact us if you run into concerns. Thanks."
                ]);
        }

        if ($language == 'fr') {

            $message = $this->client->messages->create($phoneNumber,
                ["from" => $this->twilioNumber,
                    "body" => "Bonjour, Vous avez été référé à Dohzy par $referrerName\nPour Utiliser la plateforme Dohzy pour obtenir un prêt. Il vous suffit de créer un compte et d'utiliser le code de référence ci-dessous pour demander un prêt.\nCode de référence: $referralCode \nMerci d'avoir utilisé Dohzy Inc. N'hésitez pas à nous contacter pour toute préoccupation"
                ]);

        }

    }

    public function sendMoneyRequestMessageToAdmin($adminPhoneNumber, $userAccountId)
    {

        $message = $this->client->messages->create($adminPhoneNumber,
            ["from" => $this->twilioNumber,
                "body" => "Hello admin, a user requested for funds.\n User account id : $userAccountId"
            ]);

    }


    public function sendRecommendationMessageToAdmin($adminPhoneNumber, $userAccountId)
    {

        $message = $this->client->messages->create($adminPhoneNumber,
            ["from" => $this->twilioNumber,
                "body" => "Hello admin, a user has recommended another user. Below is the id of the user that recommended another user.\n User account id : $userAccountId"
            ]);

    }

    public function sendReferralCodeRequestMessageToAdmin($adminPhoneNumber, $userAccountId)
    {

        $message = $this->client->messages->create($adminPhoneNumber,
            ["from" => $this->twilioNumber,
                "body" => "Hello admin, requested for a referral code. Below is the id of the user.\n User account id : $userAccountId"
            ]);

    }

    public function sendLoanPaymentMessageToAdmin($adminPhoneNumber, $loanId, $amountSent, $moneyPassword)
    {

        $message = $this->client->messages->create($adminPhoneNumber,
            ["from" => $this->twilioNumber,
                "body" => "Hello admin, a user has made a payment.\n Loan id: $loanId\n Amount: $amountSent\n password: $moneyPassword "
            ]);

    }


    public function sendTextMessageFromAdmin($phoneNumber, $textMessage)
    {

        $message = $this->client->messages->create($phoneNumber,
            ["from" => $this->twilioNumber,
                "body" => "$textMessage"
            ]);

    }

    public function sendNewUserAccountCreatedMessageToAdmin($adminPhoneNumber, $accountId)
    {

        $message = $this->client->messages->create($adminPhoneNumber,
            ["from" => $this->twilioNumber,
                "body" => "Hello admin, a new user has created an account.\n userAccountId: $accountId\n please log in as admin to check the details"
            ]);

    }


    public function sendPhoneVerificationCode($recipientPhoneNumber, $phoneVerificationCode, $userLanguage)
    {

        if ($userLanguage == 'en') {
            $message = $this->client->messages
                ->create($recipientPhoneNumber, ["from" => $this->twilioNumber,
                    "body" => "Your Phone verification code is " . $phoneVerificationCode]);
        }

        if ($userLanguage == 'fr') {
            $message = $this->client->messages
                ->create($recipientPhoneNumber, ["from" => $this->twilioNumber,
                    "body" => "Le code de vérification pour votre téléphone est " . $phoneVerificationCode]);
        }

    }

    public function generatePhoneVerificationCode()
    {
        return rand(1000, 9999);
    }

    public function cleanUpPhoneNumber($phoneNumber)
    {
        //remove spaces
        $phoneNumber = preg_replace('/\s+/', '', $phoneNumber);
        //remove dashes
        $phoneNumber = str_replace('-', '', $phoneNumber);

        return $phoneNumber;

    }

    public function addCountryCodeToNumber($countryCode, $phoneNumber)
    {

        return $countryCode . $phoneNumber;
    }


//getPhoneVerificationStatus()

//checkPhoneVerificationCode()

   public function sendTontineContributionMessageToAdmin($adminPhoneNumber, $userAccountId, $moneyTransferPassword){

      $message = $this->client->messages->create($adminPhoneNumber,
        ["from" => $this->twilioNumber,
            "body" => "Hello admin, a user contributed to their tontine. Below is the id of the user.\n User account id : $userAccountId\n Transfer password is : $moneyTransferPassword"
        ]);

   }


   public function sendWalletWithdrawRequestMessageToAdmin( $adminPhoneNumber, $userAccountId, $withdrawAmount,$emailForTransfer,$withdrawalDateTimeEST){

       $message = $this->client->messages->create($adminPhoneNumber,
        [ "from" => $this->twilioNumber,
          "body" => "Hello admin, a user made a request to withdraw funds from their wallet. Below is the id of the user.\n User account id : $userAccountId\n Withdraw amount is :$ $withdrawAmount\n Email for etransfer : $emailForTransfer\n  Time of request : $withdrawalDateTimeEST "
        ]);

   }





}

?>
