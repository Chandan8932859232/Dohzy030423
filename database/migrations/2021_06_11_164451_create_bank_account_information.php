<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_account_information', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('user_id')->nullable();
            $table->string('loan_id')->nullable();
            $table->string('institution_number')->nullable();
            $table->string('transit_number')->nullable();
            $table->string('account_number')->nullable();
            $table->string('void_cheque')->nullable();
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
        Schema::dropIfExists('bank_account_information');
    }
}
