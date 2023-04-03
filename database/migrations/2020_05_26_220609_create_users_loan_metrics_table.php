<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLoanMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_loan_metrics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->integer('interest_rate')->default(10)->nullable();
            $table->integer('applications')->default(0)->nullable();
            $table->integer('approvals')->default(0)->nullable();
            $table->integer('unapproved')->default(0)->nullable();
            $table->integer('late_payments')->default(0)->nullable();
            $table->integer('timely_payments')->default(0)->nullable();
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
        Schema::dropIfExists('users_loan_metrics');
    }
}
