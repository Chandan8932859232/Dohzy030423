<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;

class SecurityService
{

    public function getActionCountry($ip)
    {
        $client = $ip;
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = @$_SERVER['REMOTE_ADDR'];
        $result = array('country' => '');
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        $country = "";
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if ($ip_data && $ip_data->geoplugin_countryName != null) {
            $country = $ip_data->geoplugin_countryCode;
        }
        return $country;
    }

    public function isActionCountryAddressCountry($userId)
    {
        $address = Address::where('user_id', $userId)->first();
        if (empty($address))
            return false;
        if ($address->country_code != $this->getActionCountry(Request()->getClientIp()))
            return false;
        return true;
    }


    public function getClientIpAddress(){

        return Request()->getClientIp();

    }

    public function getActionLocationInfo($userIp){
        //this takes ip as parameter and returns country, city, province

        $userLocation= array();
        
        $locationData = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $userIp));

        if ($locationData->geoplugin_status == 200) {
            $country = $locationData->geoplugin_countryName;
            $state =   $locationData->geoplugin_regionName;
            $city = $locationData->geoplugin_city;
            $latitude = 'la'.$locationData->geoplugin_latitude;
            $longditude = 'lo'.$locationData->geoplugin_longitude;

            array_push($userLocation,$country,$state,$city,$latitude,$longditude);

            return $userLocation;
        }
        else
           
          return "NA";

    
    }



    public function calculateLoanSecurityScore($loanId, $userId){

        $initialLoanSecurityScore = Loan::where('id', $loanId)->value('security_score');

        if(!$this->isActionCountryAddressCountry($userId)) {

            $loanSecurityScore = $initialLoanSecurityScore + 1 ; // increment score by 1

            //update security score 
            Loan::where('id', $loanId)
            ->update(['security_score' => $loanSecurityScore]);

            return Loan::where('id', $loanId)->value('security_score');
        }

        return $initialLoanSecurityScore;

    }




}
