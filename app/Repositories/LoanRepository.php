<?php

namespace  App\Repositories;

use App\Models\Loan;

class LoanRepository implements LoanRepositoryInterface {



    public function getApplicationType($applicationId){
        /* get the type of application (could be group-member, non-group member)
         * @params:applicationId
         * return int
         */

        return  Loan::where('id', $applicationId)->value('application_type');

    }













}
