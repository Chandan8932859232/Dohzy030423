<?php

namespace App\Services;

use App\Models\Wallet;

class WalletService{


public function __construct()
{
    
}

public function createWallet($userId){


    $walletId = $this->generateWalletId();
    $initialBalance = 0;

    $wallet = new Wallet;

    $wallet->id = $walletId;
    $wallet->user_id = $userId;
    $wallet->balance = $initialBalance;

    $wallet->save();

}

public function generateWalletId(){

    $walletId = "WALLET".substr(md5(uniqid()),0,4).mt_rand(100, 800);

    if($this->walletIdExist($walletId)){

        return $this->generateWalletId(); //if Exist call generate again
    }

    return  $walletId;
}


public function walletIdExist($walletId)
{
    return  Wallet::where('id',$walletId)->first();
}












}


?>