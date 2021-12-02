<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletJourneyTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_journey_time', function (Blueprint $table) {
            $table->increments("id");
            $table->string('type');
            $table->id("timesheet_id");
            $table->string("employee_id");
            $table->date('date');
            $table->date('checkin_time');
            $table->date('checkout_time');

            $table->string('is_active')->default('1');
            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('employee');
            $table->foreign('timesheet_id')->references('id')->on('merchant_time_sheet');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outlet_journey_time');
    }
}
