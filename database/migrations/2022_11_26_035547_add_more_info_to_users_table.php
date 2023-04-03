<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('work_industry')->after('account_creation_location')->nullable();
            $table->integer('years_in_canada')->after('work_industry')->nullable();
            $table->integer('marital_status')->after('years_in_canada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('work_industry');
            $table->dropColumn('years_in_canada');
            $table->dropColumn('marital_status');

        });
    }
}
