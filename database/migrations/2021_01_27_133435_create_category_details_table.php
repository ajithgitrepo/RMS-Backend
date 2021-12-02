<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('category_details', function (Blueprint $table) {
          //  $table->increments("id");
          //  $table->unsignedInteger('brand_id');
            $table->string('category_name');
            $table->string('is_active')->default('1');
            $table->string('created_by');
            $table->timestamps();
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
        Schema::dropIfExists('category_details');
    }
}

