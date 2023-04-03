<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankAccountInformation extends Model
{

    public const RBC_INSTITUTION_NUMBER = 003;
    public const CIBC_INSTITUTION_NUMBER = 010;
    public const BMO_INSTITUTION_NUMBER = 001;
    public const SCOTIA_INSTITUTION_NUMBER = 002;
    public const TD_INSTITUTION_NUMBER = 004;
    public const DESJARDIN_INSTITUTION_NUMBER = 815;

    public  $incrementing  = false;

    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'institution_number',
        'transit_number',
        'account_number',
        'void_cheque'
    ];

    //primary key
    protected $primaryKey ='id'; //could be changed here

    //table name
    protected $table ='bank_account_information';  //could be changed here


    public function  isBankingAccountInfoPresent($userId): bool
    {

        $bankInfo = DB::table('bank_account_information')->where('user_id', '=', $userId)->get();

        if($bankInfo->count()){
            return true;
        }
        return false;
    }


}
