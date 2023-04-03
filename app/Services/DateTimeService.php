<?php
namespace App\Services;


class DateTimeService{


    public function convertTimeToEST($utc_date){
        # using utc date convert date to user date
        $user_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $utc_date, 'UTC');
        $user_date->setTimezone('America/Toronto');


        return $user_date;
    }


}





