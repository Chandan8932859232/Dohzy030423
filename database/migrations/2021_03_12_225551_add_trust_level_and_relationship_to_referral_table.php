<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrustLevelAndRelationshipToReferralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('individual_referral_codes', function (Blueprint $table) {
            $table->integer('relationship')->nullable();
            $table->string('trust_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('individual_referral_codes', function (Blueprint $table) {
            //
        });
    }
}
