<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_balance', function (Blueprint $table) {
            $table->increments("id");
            $table->string("employee_id");
            $table->integer("Annual_Leave");
            $table->integer("Meternity_Leave");
            $table->integer("Sick_Leave");
            $table->integer("Casual_Leave");
            $table->integer("Emergency_Leave");
            $table->string("is_active")->default(1);
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
        Schema::dropIfExists('leave_balance');
    }
}
