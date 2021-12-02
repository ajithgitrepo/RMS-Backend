<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('employee_id')->nullable();
            $table->string('is_present')->default('0');
            $table->string('is_leave')->default('0');
            $table->time('checkin_time')->nullable();
            $table->time('checkout_time')->nullable();
            $table->string('is_leave_approved')->default('0');
            $table->string('leave_approved_by')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('attendance');
    }
}
