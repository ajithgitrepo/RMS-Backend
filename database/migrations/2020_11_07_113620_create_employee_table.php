<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->string('employee_id')->primary();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->string('passport_number');
            $table->string('nationality');
            $table->string('mobile_number');
            $table->string('email')->unique();
            $table->unsignedInteger('designation');
            $table->string('department');
            $table->date('joining_date');
            $table->date('visa_exp_date');
            $table->date('passport_exp_date');
            $table->string('medical_ins_no')->nullable();
            $table->date('medical_ins_exp_date')->nullable();
            $table->string('visa_company_name');
            $table->string('employee_score')->nullable();
            $table->string('is_active');
            $table->timestamps();


            $table->foreign('designation')->references('id')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     
    public function down()
    {
        Schema::dropIfExists('employee');
        //$table->dropColumn('picture');
        
    //     Schema::table('employee', function($table) {
          // $table->dropColumn('picture');
       //  });
        
    }
    

}
