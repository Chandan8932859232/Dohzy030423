<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansWaitingListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans_waiting_list', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('user_id')->nullable();
            $table->integer('loan_type')->nullable();
            $table->integer('wait_status')->default(1)->nullable();

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
        Schema::dropIfExists('loans_waiting_list');
    }
}
