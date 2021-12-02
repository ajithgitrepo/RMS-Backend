<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCdeReportingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cde_reporting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('merchandiser_id')->nullable();
            $table->string('cde_id')->nullable();
            $table->date('reporting_date')->nullable();
            $table->date('reporting_end_date')->nullable();
            $table->string('created_by')->nullable();;
            $table->string('is_active')->default('1');
            $table->timestamps();

            $table->foreign('merchandiser_id')->references('employee_id')->on('employee');
            $table->foreign('cde_id')->references('employee_id')->on('employee');
            $table->foreign('created_by')->references('employee_id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cde_reporting');
    }
}
