<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuletSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oulet_survey', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('timeshet_id');
            $table->date('date');
            $table->time('time');
            $table->string('employee_id');
            $table->integer('availability')->default('0');
            $table->integer('visibility')->default('0');
            $table->integer('shareofself')->default('0');
            $table->integer('promotioncheck')->default('0');
            $table->integer('planogramcheck')->default('0');
            $table->integer('compitetorinfo')->default('0');
            $table->integer('stockexpiry')->default('0');

          //  $table->string('created_to');
           
            $table->integer('is_active');
            $table->timestamps();
            $table->foreign('employee_id')->references('employee_id')->on('employee');
            $table->foreign('timeshet_id')->references('id')->on('merchant_time_sheet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oulet_survey');
    }
}
