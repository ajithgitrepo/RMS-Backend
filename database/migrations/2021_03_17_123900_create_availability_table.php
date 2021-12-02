<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availability', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('outlet_id');
            $table->unsignedInteger('timesheet_id');
            $table->unsignedInteger('product_id');
            $table->string('brand_name')->nullable();
            $table->string('category_name')->nullable();
            $table->string('product_name')->nullable();
            $table->string('is_available')->nullable();
            $table->string('reason')->nullable();
            $table->string('remarks')->nullable();
            $table->string('is_active')->nullable();
            $table->timestamps();

            $table->foreign('outlet_id')->references('id')->on('outlet');
            $table->foreign('timesheet_id')->references('outlet_id')->on('merchant_time_sheet');
            $table->foreign('product_id')->references('id')->on('product_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availability');
    }
}
