<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_details', function (Blueprint $table) {
            $table->increments("id");
            $table->string("brand_name");
            $table->string("client_id");
            $table->string("field_manager_id");
            $table->string("sales_manager_id");
            $table->string("created_by");
            $table->string("updates_by")->nullable();
            $table->string('is_active')->default('1');
            $table->timestamps();
            
            $table->foreign('client_id')->references('employee_id')->on('employee');
            $table->foreign('field_manager_id')->references('employee_id')->on('employee');
            $table->foreign('sales_manager_id')->references('employee_id')->on('employee');
            $table->foreign('updates_by')->references('employee_id')->on('employee');
            $table->foreign('created_by')->references('employee_id')->on('employee');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_details');
    }
}
