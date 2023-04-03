<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTontineParticipationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_tontine_participation', function (Blueprint $table) {

            $table->id();

            $table->string('user_id')->nullable();
            $table->string('plan')->nullable();
            $table->string('start_month')->nullable();
            $table->string('receive_month')->nullable();
            $table->string('purpose')->nullable();

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
        Schema::dropIfExists('request_tontine_participation');
    }
}
