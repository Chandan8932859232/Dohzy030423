<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id')->nullable();
            $table->string('employee_first_name')->nullable();
            $table->string('employee_last_name')->nullable();
            $table->string('employee_email')->nullable();
            $table->string('employee_password')->nullable();
            $table->string('employee_role')->nullable();
            $table->string('employee_phone_number')->nullable();
            $table->string('employee_address')->nullable();
            $table->string('employee_status')->nullable();
            $table->string('employee_position')->nullable();

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
        Schema::dropIfExists('employees');
    }
}
