<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansInstallmentRefundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans_installment_refund', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('loan_id')->nullable();
            $table->integer('number_of_installments')->nullable();
            $table->string('payback_dates')->nullable();
            $table->string('amount_per_installment')->nullable();
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
        Schema::dropIfExists('loans_installment_refund');
    }
}
