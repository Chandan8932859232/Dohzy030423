<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTontineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tontine_2022_2023', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('user_id')->nullable();
            $table->string('contribution_amount')->nullable();
            $table->date('receive_date')->nullable();
            $table->string('receive_amount')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('contribution_deadline')->default(25);
            $table->integer('status')->default(0);

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
        Schema::dropIfExists('tontine');
    }
}
