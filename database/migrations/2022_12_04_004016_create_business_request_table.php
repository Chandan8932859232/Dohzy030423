<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_account_request', function (Blueprint $table) {

            $table->id();

            $table->string('user_id')->nullable();
            $table->string('business_age')->nullable();
            $table->string('business_industry')->nullable();
            $table->string('business_country')->nullable();
            $table->string('business_revenue')->nullable();
            $table->string('business_description', 800)->nullable();

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
        Schema::dropIfExists('business_account_request');
    }
}
