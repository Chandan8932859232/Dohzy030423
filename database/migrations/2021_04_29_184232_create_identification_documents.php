<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentificationDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identification_documents', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('user_id')->nullable();
            $table->string('document_url')->nullable();
            $table->integer('document_verification_status')->default(0)->nullable();
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
        Schema::dropIfExists('identification_documents');
    }
}
