<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client; 

class TwilioTestController{

//twilio authentication credentials
 public $twilioSid;
 public $twilioAuthtoken;
 public $twilioNumber;

 public function __constructor(){
   $this->twilioSid = getenv("TWILIO_SID");
   $this->twilioAuthtoken = getenv("TWILIO_AUTH_TOKEN");
   $this->twilioNumber = getenv("TWILIO_NUMBER");        
 }

public function checkPhoneNumberExistence(){
    //check if phone number exist by doing a carrier lookup
    //https://www.twilio.com/docs/lookup/tutorials/carrier-and-caller-name#identify-a-phone-numbers-carrier-and-type

$twilio = new Client(getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN"));

$phone_number = $twilio->lookups->v1->phoneNumbers("+18195807428")
                                    ->fetch(["type" => ["carrier"]]);

//print($phone_number->phoneNumber); 
var_dump($phone_number->carrier); 

}

public function checkPhoneType(){

}



public function sendPhoneMessage($recipientNumber,$message){
   
   $client = new Client(getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN")); //instantiate twilio for use

   $message = $client->messages->create($recipientNumber,[ "from" =>getenv("TWILIO_NUMBER"),"body" =>$message] );
}

}