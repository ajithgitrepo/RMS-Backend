<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaverequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaverequest', function (Blueprint $table) {
        
            $table->increments('lrid');
            $table->string('employeeid');
            $table->string('leavetype');
            $table->date('leavestartdate');
            $table->date('leaveenddate');
            $table->string('is_approved');
            $table->string('is_rejected');
            $table->string('reason');
            $table->string('supportingdocument');
            $table->timestamps();

            
            $table->foreign('employeeid')->references('employee_id')->on('employee');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaverequest');
    }
}
