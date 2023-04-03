<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealEstateOwnershipDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_ownership_prove_docs', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('user_id')->nullable();
            $table->string('loan_id')->nullable();
            $table->string('document_url')->nullable();
            $table->string('document_verification_status')->default(0);
            $table->string('document_type')->nullable();
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
        Schema::dropIfExists('eal_estate_ownership_prove_docs');
    }
}
