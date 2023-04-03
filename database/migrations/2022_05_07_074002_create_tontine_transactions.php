<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTontineTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tontine_transactions', function (Blueprint $table) {

            $table->string('id');
            $table->string('user_id')->nullable();
            $table->date('contribute_date')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('contribute_status')->default(1);
            $table->string('contribute_password')->nullable();
            $table->integer('transaction_type')->default(1);
          
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
        Schema::dropIfExists('tontine_transactions');
    }
}
