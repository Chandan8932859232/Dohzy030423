<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Loan extends Model
{
    use SoftDeletes;

    public const MINUTES_BEFORE_LOAN_APPLICATION_STARTS = 1;

    public const PERSONAL_LOAN = 1;
    public const REAL_ESTATE_LOAN =3;
    public const BUSINESS_LOAN = 4;

    //public const GROUP_MEMBER_APPLICATION = 1;

    //loan state constants
    public const APPLICATION_NOT_RECEIVED = 0;
    public const APPLICATION_RECEIVED = 1;
    public const APPLICATION_IS_PROCESSING = 2;
    public const APPLICATION_AWAITING_USER_APPROVAL = 3;
    public const APPLICATION_PROCESSED_AND_REJECTED = 4;
    public const APPLICATION_APPROVED_AND_MONEY_WILL_BE_SENT = 5;
    public const APPLICATION_APPROVED_AND_MONEY_SENT = 6;
    public const LOAN_PAYMENT_MADE_BUT_TO_BE_VERIFIED = 7;
    public const LOAN_COMPLETELY_REPAID = 8;
    public const LOAN_TERMS_AND_CONDITIONS_REJECTED = 9;
    public const LOAN_REPAYMENT_IS_ONGOING = 10;

    public const LOAN_IS_WITH_INTERNAL_COLLECTIONS = 11;
    public const LOAN_IS_WITH_EXTERNAL_COLLECTIONS = 12;
    public const LOAN_WAS_RECOVERED_FROM_EXTERNAL_COLLECTIONS = 13;



    public  $incrementing  = false;

    //
    protected $fillable = [
        'id',
        'applicant_user_id',
        'application_amount',
        'applicant_proposed_back_date',
        'application_receive_money_date',
        'application_interact_method',
        'application_interact_email',
        'application_interact_autodeposit_status',
        'application_send_money_method',
        'application_referral_code',
        'application_status',
        'application_type',
        'send_interac_password',
        'receive_interac_password',
        'payback_amount',
        'charges',
        'balance'
    ];

    //table name
    protected $table ='loans';  //could be changed here

    //primary key
    public $primaryKey ='id'; //could be changed here
    /**
     * @var array|string|null
     */


     public function getLoanBalance($loanId){

        return Loan::where('id', $loanId)->value('balance');

    }


}
