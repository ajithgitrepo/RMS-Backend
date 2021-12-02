<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('document_id');
            $table->string('employee_id');
            $table->string('passport_photo');
            $table->string('passport_copy');
            $table->string('visa_copy');
            $table->string('dl_copy');
            $table->date('dl_expiry');
            $table->date('passport_expiry');
            $table->string('edu_certificate');
            $table->string('exp_certificate');
            $table->string('is_active');
            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
