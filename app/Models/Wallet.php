<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
    public  $incrementing  = false;

    //table name
    protected $table ='wallets';  //could be changed here

    //primary key
     public $primaryKey ='id'; //could be changed here

    //
    protected $fillable = [
        'id',
        'user_id',
        'balance'
    ];


    public function getWalletBalance($userId){

        $walletBalance = Wallet::where('user_id', $userId)->value('balance');

        return number_format($walletBalance, 2);

    }

    public function getWalletBalanceRaw($userId){

        return $walletBalance = Wallet::where('user_id', $userId)->value('balance');

        //return number_format($walletBalance, 2);

    }




}
