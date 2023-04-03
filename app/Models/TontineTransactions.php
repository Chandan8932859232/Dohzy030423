<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TontineTransactions extends Model
{
    //
    public const CONTRIBUTION_TRANSACTION_TYPE = 1;
    public const RECEIVE_TRANSACTION_TYPE = 2;

    public  $incrementing  = false;

    //
    protected $fillable = [
        'id',
        'user_id',
        'contribute_date',
        'amount_paid',
        'contribute_password',
        'contribute_status',
        'transaction_type',
    ];

    //table name
     protected $table ='tontine_transactions';  //could be changed here

   

    //primary key
    public $primaryKey ='id'; //could be changed here
    /**
     * @var array|string|null
     */

}