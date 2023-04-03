<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransactions extends Model
{
    // wallet transaction types
    public const DEBIT_TRANSACTION = 1;
    public const CREDIT_TRANSACTION = 2;


    // wallet transaction statuses
    public const TRANSACTION_COMPLETE = 1;
    public const TRANSACTON_TO_BE_PROCESSED = 2;
    public const TRANSACTION_TO_BE_VERIFIED = 3;

    // wallet withdrawal reasons
    //public const TONTINE_RECEIVE 
  

    // wallet contribution reasons

    
    public  $incrementing  = false;

    //table name
    protected $table ='wallet_transactions';  //could be changed here
    
    //primary key
    public $primaryKey ='id'; //could be changed here
    
    //
    protected $fillable = [
            'id',
            'user_id',
            'type',
            'status',
            'date',
            'reason',
            'balance'
   ];
 
   
}
