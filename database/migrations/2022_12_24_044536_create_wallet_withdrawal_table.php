<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletWithdrawalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_withdrawal_request', function (Blueprint $table) {

            $table->id();
            $table->string('user_id')->nullable();
            $table->string('withdrawal_amount')->nullable();
            $table->integer('transfer_method')->default(1);
            $table->string('transfer_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_withdrawal_request');
    }
}
