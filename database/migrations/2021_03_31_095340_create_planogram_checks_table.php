<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanogramChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planogram_checks', function (Blueprint $table) {
                $table->increments('id');
                $table->date("date");
                $table->unsignedInteger('outlet_id');
                $table->unsignedInteger('timesheet_id');
                $table->unsignedInteger('product_id');
                $table->unsignedInteger('brand_id');
                $table->unsignedInteger('outlet_products_mapping_id');
                $table->string('brand_name')->nullable();
                $table->string('category_name')->nullable();
                $table->string('product_name')->nullable();
                $table->string('default_image')->nullable();
               // $table->string('default_image')->nullable();
                $table->string('before_image')->nullable();
                $table->string('after_image')->nullable();
              
                $table->string('is_active')->nullable();
                $table->timestamps();  
                
                $table->foreign('outlet_products_mapping_id')->references('id')->on('outlet_products_mapping');
                $table->foreign('outlet_id')->references('id')->on('outlet');
                $table->foreign('timesheet_id')->references('id')->on('merchant_time_sheet');
                $table->foreign('product_id')->references('id')->on('product_details');
                $table->foreign('brand_id')->references('id')->on('brand_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planogram_checks');
    }
}
