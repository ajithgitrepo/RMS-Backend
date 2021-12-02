<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_login', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('employee_id');
            $table->UnsignedInteger('outlet_id');
            $table->string('is_present?')->nullable();
            $table->time('checkin_time')->nullable();
            $table->time('checkout_time')->nullable();
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
        Schema::dropIfExists('outlet_login');
    }
}
