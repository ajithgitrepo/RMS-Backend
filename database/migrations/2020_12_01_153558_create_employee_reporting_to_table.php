<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeReportingToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_reporting_to', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->string('reporting_to_emp_id');
            $table->date('reporting_date');
            $table->date('reporting_end_date');
            $table->string('is_active')->default('1');
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
        Schema::dropIfExists('employee_reporting_to');
    }
}
