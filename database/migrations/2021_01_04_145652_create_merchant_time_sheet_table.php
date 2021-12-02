<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantTimeSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_time_sheet', function (Blueprint $table) {
            $table->increments("id");
            $table->date('date')->nullable();
            $table->string('employee_id');
            $table->UnsignedInteger('outlet_id');
            $table->string('is_present?')->nullable();
            $table->time('checkin_time')->nullable();
            $table->time('checkout_time')->nullable();
            $table->integer('scheduled_calls')->nullable();
            $table->text('checkin_location')->nullable();
            $table->text('checkout_location')->nullable();
            $table->string('salesman_approval')->nullable();
            $table->string('salesman_remarks')->nullable();
            $table->date('salesman_approved_date')->nullable();
            $table->string('client_approval')->nullable();
            $table->string('remarks')->nullable();
            $table->string('is_active')->default(1);
            $table->string('is_completed')->default(0);
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('employee');

            $table->foreign('outlet_id')->references('outlet_id')->on('outlet');

        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_time_sheet');
    }
}
